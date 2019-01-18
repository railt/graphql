<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Validation\Definitions;

use Railt\SDL\Contracts\Definitions\Definition;
use Railt\SDL\Contracts\Definitions\DirectiveDefinition;
use Railt\SDL\Contracts\Dependent\ArgumentDefinition;
use Railt\SDL\Contracts\Invocations\DirectiveInvocation;
use Railt\SDL\Exceptions\TypeConflictException;

/**
 * Class DirectiveInvocationValidator
 */
class DirectiveInvocationValidator extends BaseDefinitionValidator
{
    /**
     * @param Definition $definition
     * @return bool
     */
    public function match(Definition $definition): bool
    {
        return $definition instanceof DirectiveInvocation;
    }

    /**
     * @param Definition|DirectiveInvocation $definition
     */
    public function validate(Definition $definition): void
    {
        $this->validateDirectiveLocation($definition);

        $parent = $definition->getParent();
        if ($parent instanceof ArgumentDefinition) {
            $this->validateArgumentDirective($definition, $parent);
        }
    }

    /**
     * @param DirectiveInvocation $directive
     * @return void
     */
    private function validateDirectiveLocation(DirectiveInvocation $directive): void
    {
        /** @var DirectiveDefinition $definition */
        $definition = $directive->getTypeDefinition();

        if (! $definition->isAllowedFor($directive->getParent())) {
            $error = \vsprintf('Trying to define directive %s on %s, but only %s locations allowed.', [
                $directive,
                $directive->getParent(),
                \implode(', ', $definition->getLocations()),
            ]);
            throw new TypeConflictException($error, $this->getCallStack());
        }
    }

    /**
     * @param DirectiveInvocation $definition
     * @param ArgumentDefinition $arg
     */
    private function validateArgumentDirective(DirectiveInvocation $definition, ArgumentDefinition $arg): void
    {
        $parent = $arg->getParent();

        if ($parent instanceof DirectiveDefinition) {
            $this->validateDirectiveLocatedDirective($definition, $parent);
        }
    }

    /**
     * @param DirectiveInvocation $invoke
     * @param DirectiveDefinition $def
     * @throws \Railt\SDL\Exceptions\TypeConflictException
     */
    private function validateDirectiveLocatedDirective(DirectiveInvocation $invoke, DirectiveDefinition $def): void
    {
        if ($def->getName() === $invoke->getName()) {
            $error = \sprintf('Can not define the %s on %s to itself', $def, $invoke->getParent());
            throw new TypeConflictException($error, $this->getCallStack());
        }
    }
}
