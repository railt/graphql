<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Record;

use Railt\Compiler\Parser\Ast\RuleInterface;
use Railt\Io\Position;
use Railt\Io\Readable;
use Railt\SDL\Compiler\Context\LocalContextInterface;
use Railt\SDL\Compiler\Dependency;
use Railt\SDL\Heap\PriorityInterface;
use Railt\SDL\Stack\CallStackInterface;

/**
 * Class Record
 */
abstract class Record implements RecordInterface
{
    /**
     * @var RuleInterface
     */
    private $ast;

    /**
     * @var LocalContextInterface
     */
    private $context;

    /**
     * @var Position
     */
    private $position;

    /**
     * Record constructor.
     * @param LocalContextInterface $context
     * @param RuleInterface $ast
     */
    public function __construct(LocalContextInterface $context, RuleInterface $ast)
    {
        $this->ast      = $ast;
        $this->context  = $context;
        $this->position = $context->getFile()->getPosition($ast->getOffset());
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return PriorityInterface::DEFAULT;
    }

    /**
     * @return RuleInterface
     */
    public function getAst(): RuleInterface
    {
        return $this->ast;
    }

    /**
     * @return LocalContextInterface
     */
    public function getContext(): LocalContextInterface
    {
        return $this->context;
    }

    /**
     * @return CallStackInterface
     */
    protected function getCallStack(): CallStackInterface
    {
        return $this->getContext()->getCallStack();
    }

    /**
     * @return Readable
     */
    public function getFile(): Readable
    {
        return $this->context->getFile();
    }

    /**
     * @return int
     */
    public function getLine(): int
    {
        return $this->position->getLine();
    }

    /**
     * @return int
     */
    public function getColumn(): int
    {
        return $this->position->getColumn();
    }

    /**
     * @param null|RuleInterface $ast
     * @param \Closure $then
     * @return mixed
     */
    protected function withAst(?RuleInterface $ast, \Closure $then)
    {
        \assert($ast !== null, 'Internal Error: Bad AST extraction logic');

        $this->getCallStack()->pushAst($this->getFile(), $ast);

        $result = $then($ast);

        $this->getCallStack()->pop();

        return $result;
    }

    /**
     * @return iterable
     */
    public function getDependencies(): iterable
    {
        return [];
    }
}
