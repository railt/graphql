<?php

/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\SDL\Executor\Registrar;

use Phplrt\Contracts\Ast\NodeInterface;
use Phplrt\Source\Exception\NotAccessibleException;
use Phplrt\Visitor\Traverser;
use Railt\SDL\Ast\Definition\DirectiveDefinitionNode;
use Railt\SDL\Exception\TypeErrorException;

/**
 * Class DirectiveDefinition
 */
class DirectiveDefinition extends TypeRegistrar
{
    /**
     * @var string
     */
    private const ERROR_DIRECTIVE_REDEFINITION = 'There can be only one directive named @%s';

    /**
     * @param NodeInterface $directive
     * @return int|void
     * @throws TypeErrorException
     * @throws NotAccessibleException
     * @throws \RuntimeException
     */
    public function enter(NodeInterface $directive)
    {
        if ($directive instanceof DirectiveDefinitionNode) {
            $this->assertUniqueness($directive);

            \assert($this->context->note('[Registry] Add directive <%s>', $directive->name->value));

            $this->registry->directives[$directive->name->value] = $directive;

            //
            // Temporary optimization.
            // If there is an implementation of nested types,
            // then this code should be deleted.
            //
            return Traverser::DONT_TRAVERSE_CHILDREN;
        }
    }

    /**
     * @param DirectiveDefinitionNode $type
     * @return void
     * @throws NotAccessibleException
     * @throws TypeErrorException
     * @throws \RuntimeException
     */
    private function assertUniqueness(DirectiveDefinitionNode $type): void
    {
        $exists = isset($this->registry->directives[$type->name->value])
            || $this->document->hasDirective($type->name->value);

        if ($exists) {
            $message = \sprintf(self::ERROR_DIRECTIVE_REDEFINITION, $type->name->value);

            throw new TypeErrorException($message, $type);
        }
    }
}
