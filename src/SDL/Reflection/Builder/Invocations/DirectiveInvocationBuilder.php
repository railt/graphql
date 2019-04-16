<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Component\SDL\Reflection\Builder\Invocations;

use Railt\Component\Parser\Ast\NodeInterface;
use Railt\Component\Parser\Ast\RuleInterface;
use Railt\Component\SDL\Base\Invocations\BaseDirectiveInvocation;
use Railt\Component\SDL\Contracts\Definitions\DirectiveDefinition;
use Railt\Component\SDL\Contracts\Definitions\TypeDefinition;
use Railt\Component\SDL\Contracts\Dependent\ArgumentDefinition;
use Railt\Component\SDL\Contracts\Document;
use Railt\Component\SDL\Exceptions\TypeConflictException;
use Railt\Component\SDL\Reflection\Builder\DocumentBuilder;
use Railt\Component\SDL\Reflection\Builder\Process\Compilable;
use Railt\Component\SDL\Reflection\Builder\Process\Compiler;

/**
 * Class DirectiveInvocationBuilder
 */
class DirectiveInvocationBuilder extends BaseDirectiveInvocation implements Compilable
{
    use Compiler;

    /**
     * DirectiveInvocationBuilder constructor.
     *
     * @param NodeInterface $ast
     * @param DocumentBuilder|Document $document
     * @param TypeDefinition $parent
     * @throws \OutOfBoundsException
     */
    public function __construct(NodeInterface $ast, DocumentBuilder $document, TypeDefinition $parent)
    {
        $this->parent = $parent;
        $this->boot($ast, $document);
    }

    /**
     * @param NodeInterface $ast
     * @return bool
     * @throws \Railt\Component\SDL\Exceptions\TypeConflictException
     */
    protected function onCompile(NodeInterface $ast): bool
    {
        if ($ast->is('Argument')) {
            [$name, $value] = $this->parseArgumentValue($ast);

            /** @var DirectiveDefinition $definition */
            $definition = $this->getTypeDefinition();
            /** @var ArgumentDefinition|null $argument */
            $argument = $definition->getArgument($name);

            if (! $argument) {
                $this->getCompiler()->getCallStack()->push($definition);

                $error = \sprintf('Argument %s not defined in %s', $name, $definition);
                throw new TypeConflictException($error, $this->getCompiler()->getCallStack());
            }

            $typeName = $argument->getTypeDefinition()->getName();

            $this->arguments[$name] = $this->parseValue($value, $typeName);

            return true;
        }

        return false;
    }

    /**
     * @param NodeInterface|RuleInterface $ast
     * @return array
     */
    private function parseArgumentValue(NodeInterface $ast): array
    {
        [$key, $value] = [null, null];

        foreach ($ast->getChildren() as $child) {
            if ($child->is('Name')) {
                $key = $child->getChild(0)->getValue();
                continue;
            }

            if ($child->is('Value')) {
                $value = $child->getChild(0);
                continue;
            }
        }

        return [$key, $value];
    }

    /**
     * @return null|TypeDefinition
     */
    public function getTypeDefinition(): ?TypeDefinition
    {
        return $this->load($this->getName());
    }
}
