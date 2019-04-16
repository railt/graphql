<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Component\SDL;

use Cache\Adapter\PHPArray\ArrayCachePool;
use Psr\SimpleCache\CacheInterface;
use Railt\Component\Io\Readable;
use Railt\Component\Parser\ParserInterface;
use Railt\Component\SDL\Contracts\Definitions\Definition;
use Railt\Component\SDL\Contracts\Definitions\TypeDefinition;
use Railt\Component\SDL\Contracts\Document;
use Railt\Component\SDL\Exceptions\CompilerException;
use Railt\Component\SDL\Parser\Parser;
use Railt\Component\SDL\Reflection\Builder\DocumentBuilder;
use Railt\Component\SDL\Reflection\Builder\Process\Compilable;
use Railt\Component\SDL\Reflection\Coercion\Factory;
use Railt\Component\SDL\Reflection\Coercion\TypeCoercion;
use Railt\Component\SDL\Reflection\Dictionary;
use Railt\Component\SDL\Reflection\Loader;
use Railt\Component\SDL\Reflection\Validation\Base\ValidatorInterface;
use Railt\Component\SDL\Reflection\Validation\Definitions;
use Railt\Component\SDL\Reflection\Validation\Validator;
use Railt\Component\SDL\Runtime\CallStack;
use Railt\Component\SDL\Runtime\CallStackInterface;
use Railt\Component\SDL\Schema\CompilerInterface;
use Railt\Component\SDL\Schema\Configuration;
use Railt\Component\SDL\Standard\GraphQLDocument;
use Railt\Component\SDL\Standard\StandardType;

/**
 * Class Compiler
 */
class Compiler implements CompilerInterface, Configuration
{
    use Support;

    /**
     * @var Dictionary
     */
    private $loader;

    /**
     * @var ParserInterface
     */
    private $parser;

    /**
     * @var CacheInterface|null
     */
    private $storage;

    /**
     * @var Validator
     */
    private $typeValidator;

    /**
     * @var Factory|TypeCoercion
     */
    private $typeCoercion;

    /**
     * @var CallStack
     */
    private $stack;

    /**
     * Compiler constructor.
     *
     * @param CacheInterface|null $cache
     * @throws CompilerException
     * @throws Exceptions\TypeConflictException
     */
    public function __construct(CacheInterface $cache = null)
    {
        $this->parser = new Parser();
        $this->stack = new CallStack();
        $this->loader = new Loader($this, $this->stack);
        $this->typeValidator = new Validator($this->stack);
        $this->typeCoercion = new Factory();

        $this->storage = $this->bootStorage($cache);

        $this->add($this->getStandardLibrary());
    }

    /**
     * @param Document $document
     * @return CompilerInterface
     * @throws \Railt\Component\SDL\Exceptions\CompilerException
     * @throws Exceptions\TypeConflictException
     */
    public function add(Document $document): CompilerInterface
    {
        try {
            $this->complete($document);
        } catch (\OutOfBoundsException $fatal) {
            throw CompilerException::wrap($fatal);
        }

        return $this;
    }

    /**
     * @param CacheInterface|null $cache
     * @return Compiler
     */
    public function setStorage(?CacheInterface $cache): self
    {
        $this->storage = $this->bootStorage($cache);

        return $this;
    }

    /**
     * @param null|CacheInterface $storage
     * @return CacheInterface
     */
    private function bootStorage(?CacheInterface $storage): CacheInterface
    {
        return $storage instanceof CacheInterface ? $storage : new ArrayCachePool();
    }

    /**
     * @param array $extensions
     * @return GraphQLDocument
     */
    private function getStandardLibrary(array $extensions = []): GraphQLDocument
    {
        return new GraphQLDocument($this->getDictionary(), $extensions);
    }

    /**
     * @param Document $document
     * @return Document
     * @throws Exceptions\TypeConflictException
     */
    private function complete(Document $document): Document
    {
        $this->load($document);

        $build = function (Definition $definition): void {
            $this->stack->push($definition);

            if ($definition instanceof Compilable) {
                $definition->compile();
            }

            if ($definition instanceof TypeDefinition) {
                $this->typeCoercion->apply($definition);
            }

            if (! ($definition instanceof StandardType)) {
                $this->typeValidator->group(Definitions::class)->validate($definition);
            }

            $this->stack->pop();
        };

        foreach ($document->getDefinitions() as $definition) {
            $build($definition);
        }

        if ($document instanceof DocumentBuilder) {
            foreach ($document->getInvocableTypes() as $definition) {
                $build($definition);
            }
        }

        return $document;
    }

    /**
     * @param Document $document
     * @return Document|DocumentBuilder
     * @throws Exceptions\TypeConflictException
     */
    private function load(Document $document): Document
    {
        foreach ($document->getTypeDefinitions() as $type) {
            if (! $this->loader->has($type->getName())) {
                $this->stack->push($type);
                $this->loader->register($type);
                $this->stack->pop();
            }
        }

        return $document;
    }

    /**
     * @param \Closure $then
     * @return CompilerInterface
     */
    public function autoload(\Closure $then): CompilerInterface
    {
        $this->loader->autoload($then);

        return $this;
    }

    /**
     * @param Readable $readable
     * @return Document
     * @throws Exceptions\TypeConflictException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function compile(Readable $readable): Document
    {
        $document = $this->makeDocument($readable);

        $this->load($document);

        return $document->withCompiler($this);
    }

    /**
     * @param Readable $readable
     * @return Document
     * @throws CompilerException
     * @throws Exceptions\TypeConflictException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    private function makeDocument(Readable $readable): Document
    {
        if ($this->storage->has($readable->getHash())) {
            return \unserialize($this->storage->get($readable->getHash()));
        }

        $ast = $this->parser->parse($readable);

        $document = $this->complete(new DocumentBuilder($ast, $readable, $this));

        $this->storage->set($readable->getHash(), \serialize($document), 60);

        return $document;
    }

    /**
     * @param string $group
     * @return ValidatorInterface
     * @throws \OutOfBoundsException
     */
    public function getValidator(string $group): ValidatorInterface
    {
        return $this->typeValidator->group($group);
    }

    /**
     * @return ParserInterface
     */
    public function getParser(): ParserInterface
    {
        return $this->parser;
    }

    /**
     * @return TypeCoercion
     */
    public function getTypeCoercion(): TypeCoercion
    {
        return $this->typeCoercion;
    }

    /**
     * @return Dictionary
     */
    public function getDictionary(): Dictionary
    {
        return $this->loader;
    }

    /**
     * @return CallStackInterface
     */
    public function getCallStack(): CallStackInterface
    {
        return $this->stack;
    }
}
