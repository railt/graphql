<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Validation\Uniqueness;

use Railt\Reflection\Contracts\Definitions\TypeDefinition;
use Railt\SDL\Reflection\Validation\Base\ValidatorInterface;

/**
 * Interface UniquenessValidator
 */
interface UniquenessValidator extends ValidatorInterface
{
    public const REDEFINITION_ERROR = 'Can not redefine already defined %s';

    /**
     * @param mixed $container
     * @param TypeDefinition|string $item
     * @return bool
     */
    public function match($container, $item): bool;
}
