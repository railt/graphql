<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Validation\Inheritance;

use Railt\SDL\Reflection\Validation\Base\ValidatorInterface;
use Railt\Reflection\Contracts\Definitions\TypeDefinition;

/**
 * Interface InheritanceValidator
 */
interface InheritanceValidator extends ValidatorInterface
{
    /**
     * @param TypeDefinition $child
     * @param TypeDefinition $parent
     * @return bool
     */
    public function match(TypeDefinition $child, TypeDefinition $parent): bool;

    /**
     * @param TypeDefinition $child
     * @param TypeDefinition $parent
     * @return void
     */
    public function validate(TypeDefinition $child, TypeDefinition $parent): void;
}
