<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection;

use Railt\Io\File;
use Railt\Io\Readable;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\SDL\Exceptions\TypeNotFoundException;
use Railt\SDL\Kernel\CallStack;

/**
 * Class Loader
 */
class Loader extends Repository
{
    /**
     * @var CompilerInterface
     */
    private $compiler;

    /**
     * @var array|\Closure[]
     */
    private $loaders = [];

    /**
     * Loader constructor.
     * @param CompilerInterface $compiler
     * @param CallStack $stack
     */
    public function __construct(CompilerInterface $compiler, CallStack $stack)
    {
        $this->compiler = $compiler;

        parent::__construct($stack);
    }

    /**
     * @param \Closure $resolver
     * @return $this
     */
    public function autoload(\Closure $resolver)
    {
        $this->loaders[] = $resolver;

        return $this;
    }

    /**
     * @param string $name
     * @return TypeDefinition
     * @throws TypeNotFoundException
     */
    public function get(string $name): TypeDefinition
    {
        return $this->normalized($name, function (string $name) {
            try {
                return parent::get($name);
            } catch (TypeNotFoundException $error) {
                return $this->load($name);
            }
        });
    }

    /**
     * @param string $name
     * @param \Closure $type
     * @return TypeDefinition
     */
    private function normalized(string $name, \Closure $type): TypeDefinition
    {
        return $this->compiler->normalize($type($name));
    }

    /**
     * @param string $name
     * @return TypeDefinition
     */
    private function load(string $name): TypeDefinition
    {
        foreach ($this->loaders as $loader) {
            $result = $this->parseResult($loader($name));

            /**
             * Checks that the autoloader returns a valid file type.
             */
            if ($result !== null) {
                $type = $this->findType($name, $result);

                /**
                 * We check that this file contains the type definition
                 * we need, otherwise we ignore it.
                 */
                if ($type instanceof TypeDefinition) {
                    return $type;
                }
            }
        }

        $error = \sprintf('Type "%s" not found and could not be loaded', $name);
        throw new TypeNotFoundException($error, $this->stack);
    }

    /**
     * @param string|Readable|mixed $result
     * @return null|Readable
     */
    private function parseResult($result): ?Readable
    {
        if (\is_string($result)) {
            return File::fromPathname($result);
        }

        if ($result instanceof Readable) {
            return $result;
        }

        return null;
    }

    /**
     * @param string $name
     * @param Readable $readable
     * @return null|TypeDefinition
     */
    private function findType(string $name, Readable $readable): ?TypeDefinition
    {
        $document = $this->compiler->compile($readable);

        return $document->getTypeDefinition($name);
    }
}
