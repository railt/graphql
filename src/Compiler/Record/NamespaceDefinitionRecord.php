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
use Railt\SDL\Compiler\Component\ContextComponent;
use Railt\SDL\Compiler\Component\InnerDefinitionsComponent;
use Railt\SDL\Compiler\Component\NameComponent;
use Railt\SDL\Compiler\Component\TypeComponent;
use Railt\SDL\Compiler\Context\LocalContextInterface;

/**
 * Class NamespaceDefinitionRecord
 */
class NamespaceDefinitionRecord extends DefinitionRecord
{
    /**
     * @param LocalContextInterface $context
     * @param RuleInterface $ast
     */
    public function __construct(LocalContextInterface $context, RuleInterface $ast)
    {
        parent::__construct($context, $ast);

        $this->get(NameComponent::class)->isUnique(false);

        //
        // Namespace should provide a new context.
        //
        // If namespace does not contain a body ("namespace Name"), then
        // the context should not rollback after analysis this record and
        // should extend to all subsequent records.
        //
        $local = new ContextComponent($context, $this->get(NameComponent::class)->getName());
        $local->shouldRollback($this->shouldRollback($ast));
        $local->isPublic(true);
        $this->add($local);

        if ($children = $ast->find('#ChildrenDefinitions', 0)) {
            $this->add(new InnerDefinitionsComponent($children->getChildren()));
        }

        $this->add(new TypeComponent(TypeComponent::TYPE_NAMESPACE));
    }

    /**
     * @param RuleInterface $ast
     * @return bool
     */
    private function shouldRollback(RuleInterface $ast): bool
    {
        return $ast->find('#ChildrenDefinitions', 0) instanceof RuleInterface;
    }
}
