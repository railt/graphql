<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL;

use Railt\Compiler\Parser;
use Railt\Io\Readable;
use Railt\Reflection\Contracts\Definitions\Definition;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\Reflection\Contracts\Document;
use Railt\Reflection\Standard\GraphQLDocument;
use Railt\Reflection\Standard\StandardType;
use Railt\Reflection\Support;
use Railt\SDL\Exceptions\CompilerException;
use Railt\SDL\Exceptions\UnexpectedTokenException;
use Railt\SDL\Exceptions\UnrecognizedTokenException;
use Railt\SDL\Parser\Factory as ParserFactory;
use Railt\SDL\Reflection\Builder\DocumentBuilder;
use Railt\SDL\Reflection\Builder\Process\Compilable;
use Railt\SDL\Reflection\Coercion\Factory;
use Railt\SDL\Reflection\Coercion\TypeCoercion;
use Railt\SDL\Reflection\Dictionary;
use Railt\SDL\Reflection\Loader;
use Railt\SDL\Reflection\Validation\Base\ValidatorInterface;
use Railt\SDL\Reflection\Validation\Definitions;
use Railt\SDL\Reflection\Validation\Validator;
use Railt\SDL\Runtime\CallStack;
use Railt\SDL\Runtime\CallStackInterface;
use Railt\SDL\Schema\CompilerInterface;
use Railt\SDL\Schema\Configuration;
use Railt\Storage\Drivers\ArrayStorage;
use Railt\Storage\Proxy;
use Railt\Storage\Storage;

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
     * @var ParserFactory
     */
    private $parser;

    /**
     * @var Storage|ArrayStorage
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
     * @param Storage|null $storage
     * @throws \OutOfBoundsException
     * @throws CompilerException
     */
    public function __construct(Storage $storage = null)
    {
        $this->stack         = new CallStack();
        $this->parser        = (new ParserFactory())->getParser();
        $this->loader        = new Loader($this, $this->stack);
        $this->typeValidator = new Validator($this->stack);
        $this->typeCoercion  = new Factory();

        $this->storage = $this->bootStorage($storage);

        $this->add($this->getStandardLibrary());
    }

    /**
     * @param Document $document
     * @return CompilerInterface
     * @throws \Railt\SDL\Exceptions\CompilerException
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
     * @param null|Storage $storage
     * @return Storage
     */
    private function bootStorage(?Storage $storage): Storage
    {
        if ($storage === null) {
            return new ArrayStorage();
        }

        if ($storage instanceof Proxy || $storage instanceof ArrayStorage) {
            return $storage;
        }

        return new Proxy(new ArrayStorage(), $storage);
    }

    /**
     * @param array $extensions
     * @return GraphQLDocument|Document
     * @throws \OutOfBoundsException
     */
    private function getStandardLibrary(array $extensions = []): GraphQLDocument
    {
        return new GraphQLDocument($this->getDictionary(), $extensions);
    }

    /**
     * @param Document|DocumentBuilder $document
     * @return Document
     * @throws \OutOfBoundsException
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
     */
    private function load(Document $document): Document
    {
        foreach ($document->getTypeDefinitions() as $type) {
            $this->stack->push($type);
            $this->loader->register($type);
            $this->stack->pop();
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
     * @throws \OutOfBoundsException
     * @throws \Railt\SDL\Exceptions\UnrecognizedTokenException
     * @throws \Railt\SDL\Exceptions\UnexpectedTokenException
     * @throws CompilerException
     */
    public function compile(Readable $readable): Document
    {
        /** @var DocumentBuilder $document */
        $document = $this->storage->remember($readable, $this->onCompile());

        return $document->withCompiler($this);
    }

    /**
     * @return \Closure
     * @throws \OutOfBoundsException
     * @throws UnexpectedTokenException
     * @throws UnrecognizedTokenException
     * @throws CompilerException
     */
    private function onCompile(): \Closure
    {
        return function (Readable $readable): Document {
            $ast = $this->parser->parse($readable->getContents());

            return $this->complete(new DocumentBuilder($ast, $readable, $this));
        };
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
     * @return Parser
     */
    public function getParser(): Parser
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
     * @return Storage
     * @deprecated Since 1.2: Use getStorage() method instead.
     */
    public function getPersister(): Storage
    {
        \trigger_error(
            __METHOD__ . ' was renamed to getStorage and will be deleted on next release',
            \E_USER_DEPRECATED
        );

        return $this->getStorage();
    }

    /**
     * @return Storage
     */
    public function getStorage(): Storage
    {
        return $this->storage;
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
