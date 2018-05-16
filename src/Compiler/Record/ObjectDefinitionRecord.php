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
use Railt\SDL\Compiler\Context\LocalContextInterface;

/**
 * Class ObjectDefinitionRecord
 */
class ObjectDefinitionRecord extends DefinitionRecord
{
    /**
     * ObjectDefinitionRecord constructor.
     * @param LocalContextInterface $context
     * @param RuleInterface $ast
     */
    public function __construct(LocalContextInterface $context, RuleInterface $ast)
    {
        parent::__construct($context, $ast);

        //
        // Type should provide own private context
        //
        $local = new ContextComponent($context, $this->get(NameComponent::class)->getName());
        $local->isPublic(false);

        $this->add($local);

        //
        // Type can provide an inner definitions
        //
        if ($children = $ast->find('#ChildrenDefinitions', 0)) {
            $this->add(new InnerDefinitionsComponent($children->getChildren()));
        }
    }
}