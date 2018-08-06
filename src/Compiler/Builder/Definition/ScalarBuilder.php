<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Builder\Definition;

use Railt\Parser\Ast\RuleInterface;
use Railt\Reflection\Contracts\Definition;
use Railt\Reflection\Definition\ScalarDefinition;
use Railt\SDL\Compiler\Ast\Definition\ScalarDefinitionNode;
use Railt\SDL\Compiler\Builder\Builder;

/**
 * Class ScalarBuilder
 */
class ScalarBuilder extends Builder
{
    /**
     * @param RuleInterface|ScalarDefinitionNode $rule
     * @param Definition $parent
     * @return Definition
     * @throws \Railt\Io\Exception\ExternalFileException
     */
    public function build(RuleInterface $rule, Definition $parent): Definition
    {
        $scalar = new ScalarDefinition($parent->getDocument(), $rule->getTypeName());
        $scalar->withOffset($rule->getOffset());
        $scalar->withDescription($rule->getDescription());

        foreach ($rule->getDirectives() as $ast) {
            $scalar->withDirective($this->dependent($ast, $scalar));
        }

        return $scalar;
    }
}
