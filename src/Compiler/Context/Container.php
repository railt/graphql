<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Context;

use Railt\SDL\Compiler\Component\NameComponent;
use Railt\SDL\Compiler\Component\PriorityComponent;
use Railt\SDL\Compiler\Record\RecordInterface;
use Railt\SDL\Exception\TypeNotFoundException;
use Railt\SDL\Exception\TypeRedefinitionException;

/**
 * Class Container
 */
class Container implements ProvidesTypes
{
    /**
     * @var \SplPriorityQueue|RecordInterface[]
     */
    private $records;

    /**
     * @var array|RecordInterface[]
     */
    private $definitions = [];

    /**
     * @var ContextInterface|LocalContextInterface|GlobalContextInterface
     */
    private $context;

    /**
     * Container constructor.
     * @param ContextInterface $context
     */
    public function __construct(ContextInterface $context)
    {
        $this->records = new \SplPriorityQueue();
        $this->context = $context;
    }

    /**
     * @param string $type
     * @return RecordInterface
     */
    public function get(string $type): RecordInterface
    {
        if ($this->has($type)) {
            return $this->definitions[$type];
        }

        $error = \sprintf('Type "%s" not found', $type);
        throw new TypeNotFoundException($error, $this->context->getStack());
    }

    /**
     * @param string $type
     * @return bool
     */
    public function has(string $type): bool
    {
        return \array_key_exists($type, $this->definitions);
    }

    /**
     * @param RecordInterface $record
     */
    public function push(RecordInterface $record): void
    {
        //
        // Any types can contain names.
        // These names must be unique within the current
        // execution context and, in the case of name conflicts,
        // an error should return.
        //
        if ($record->has(NameComponent::class)) {
            $name = $record->get(NameComponent::class)->getName();

            if (\array_key_exists($name, $this->definitions)) {
                $error   = 'Can not create a new type, because name "%s" already in use in %s scope';
                $context = $this->context->atRoot() ? 'global' : 'current "' . $this->context->getName() . '"';
                $error   = \sprintf($error, $name, $context);

                throw new TypeRedefinitionException($error, $this->context->getStack());
            }

            $this->definitions[$name] = $record;
        }

        $this->records->insert($record, $this->priority($record));
    }

    /**
     * @param RecordInterface $record
     * @return int
     */
    private function priority(RecordInterface $record): int
    {
        if ($record->has(PriorityComponent::class)) {
            return $record->get(PriorityComponent::class)->getPriority();
        }

        return PriorityComponent::DEFAULT;
    }

    /**
     * @return \Traversable|RecordInterface[]
     */
    public function getRecords(): \Traversable
    {
        yield from $this->records;

        yield from $this->previous(function (ProvidesTypes $types) {
            return $types->getRecords();
        });
    }

    /**
     * @return bool
     */
    private function hasPrevious(): bool
    {
        return $this->context instanceof LocalContextInterface && $this->context->previous();
    }

    /**
     * @param \Closure $applicant
     * @return \Traversable|RecordInterface[]
     */
    private function previous(\Closure $applicant): \Traversable
    {
        if ($this->hasPrevious()) {
            yield from $applicant($this->context->previous()->getTypes());
        }
    }

    /**
     * @return \Traversable|RecordInterface[]
     */
    public function getDefinitions(): \Traversable
    {
        yield from \array_values($this->definitions);

        yield from $this->previous(function (ProvidesTypes $types) {
            return $types->getDefinitions();
        });
    }
}
