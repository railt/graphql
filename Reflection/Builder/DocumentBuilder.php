<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\GraphQL\Reflection\Builder;

use Railt\GraphQL\Exceptions\BuildingException;
use Railt\GraphQL\Exceptions\CompilerException;
use Railt\GraphQL\Exceptions\TypeConflictException;
use Railt\GraphQL\Reflection\Builder\Invocations\ValueBuilder;
use Railt\GraphQL\Reflection\Builder\Process\Compilable;
use Railt\GraphQL\Reflection\Builder\Process\Compiler;
use Railt\GraphQL\Reflection\Builder\Processable\ExtendBuilder;
use Railt\GraphQL\Reflection\CompilerInterface;
use Railt\Compiler\TreeNode;
use Railt\Reflection\Base\BaseDocument;
use Railt\Reflection\Contracts\Definitions\Definition;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\Reflection\Filesystem\ReadableInterface;
use Railt\Reflection\Support;

/**
 * Class DocumentBuilder
 */
class DocumentBuilder extends BaseDocument implements Compilable
{
    use Support;
    use Compiler;

    public const AST_TYPE_MAPPING = [
        // Anonymous types
        '#SchemaDefinition'    => Definitions\SchemaBuilder::class,

        // Named types
        '#ObjectDefinition'    => Definitions\ObjectBuilder::class,
        '#InterfaceDefinition' => Definitions\InterfaceBuilder::class,
        '#UnionDefinition'     => Definitions\UnionBuilder::class,
        '#ScalarDefinition'    => Definitions\ScalarBuilder::class,
        '#EnumDefinition'      => Definitions\EnumBuilder::class,
        '#InputDefinition'     => Definitions\InputBuilder::class,
        '#DirectiveDefinition' => Definitions\DirectiveBuilder::class,

        // Modifiers
        '#ExtendDefinition'    => ExtendBuilder::class,
    ];

    /**
     * @var CompilerInterface
     */
    private $compiler;

    /**
     * @var ValueBuilder
     */
    private $valueBuilder;

    /**
     * @var \SplStack|Compilable[]
     */
    private $future;

    /**
     * DocumentBuilder constructor.
     * @param TreeNode $ast
     * @param ReadableInterface $readable
     * @param CompilerInterface $compiler
     * @throws CompilerException
     */
    public function __construct(TreeNode $ast, ReadableInterface $readable, CompilerInterface $compiler)
    {
        $this->valueBuilder = new ValueBuilder($this);
        $this->compiler     = $compiler;
        $this->file         = $readable;
        $this->future       = new \SplStack();

        try {
            $this->boot($ast, $this);
            $this->name = $readable->getPathname();
        } catch (\Exception $fatal) {
            throw CompilerException::wrap($fatal);
        }

        $this->compile();
    }

    /**
     * @param Compilable $type
     * @return DocumentBuilder
     */
    public function future(Compilable $type): self
    {
        $this->future->push($type);

        return $this;
    }

    /**
     * @return iterable
     */
    public function getInvocableTypes(): iterable
    {
        if ($this->future && $this->future->count()) {
            yield from $this->future;
        }
    }

    /**
     * @return ValueBuilder
     */
    public function getValueBuilder(): ValueBuilder
    {
        return $this->valueBuilder;
    }

    /**
     * @param CompilerInterface $compiler
     * @return DocumentBuilder
     */
    public function withCompiler(CompilerInterface $compiler): self
    {
        $this->compiler = $compiler;

        return $this;
    }

    /**
     * @return CompilerInterface
     */
    final public function getCompiler(): CompilerInterface
    {
        return $this->compiler;
    }

    /**
     * @param TreeNode $ast
     * @return bool
     * @throws \OutOfBoundsException
     * @throws TypeConflictException
     * @throws BuildingException
     */
    protected function onCompile(TreeNode $ast): bool
    {
        $class = self::AST_TYPE_MAPPING[$ast->getId()] ?? null;

        $this->verifyAst($class, $ast);

        /** @var Compilable|TypeDefinition $instance */
        $instance = new $class($ast, $this);

        $this->registerDefinition($instance);

        return true;
    }

    /**
     * @param null|string $class
     * @param TreeNode $ast
     * @return void
     * @throws BuildingException
     */
    private function verifyAst(?string $class, TreeNode $ast): void
    {
        if ($class === null) {
            $error = 'Broken abstract syntax tree, because a file %s can not contain an undefined Node %s';
            $error = \sprintf($error, $this->getName(), $ast->getId());

            throw new BuildingException($error, $this->getCompiler()->getStack());
        }
    }

    /**
     * @param Definition $definition
     * @return Definition|Definition[]
     * @throws \OutOfBoundsException
     */
    private function registerDefinition(Definition $definition)
    {
        if ($definition instanceof TypeDefinition) {
            return $this->types = $this->unique($this->types, $definition);
        }

        return $this->definitions[] = $definition;
    }
}
