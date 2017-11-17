<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Compiler\Reflection\Validation\Definitions;

use Railt\Compiler\Exceptions\TypeConflictException;
use Railt\Reflection\Contracts\Definitions\Definition;
use Railt\Reflection\Contracts\Definitions\EnumDefinition;

/**
 * Class EnumValidator
 */
class EnumValidator extends BaseDefinitionValidator
{
    /**
     * @param Definition $definition
     * @return bool
     */
    public function match(Definition $definition): bool
    {
        return $definition instanceof EnumDefinition;
    }

    /**
     * @param Definition $definition
     * @return void
     * @throws TypeConflictException
     */
    final public function validate(Definition $definition): void
    {
        $this->getCallStack()->push($definition);

        $this->verifyThatEnumNotEmpty($definition);

        $this->getCallStack()->pop();
    }

    /**
     * @param Definition|EnumDefinition $definition
     * @return void
     * @throws \Railt\Compiler\Exceptions\TypeConflictException
     */
    private function verifyThatEnumNotEmpty(Definition $definition): void
    {
        if (\count($definition->getValues()) === 0) {
            $error = \sprintf('%s can not be empty', $definition);
            throw new TypeConflictException($error, $this->getCallStack());
        }
    }
}
