<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Definition\Common;

use Railt\SDL\Reflection\Definition\TypeDefinition;

/**
 * An interface that says that the parent type is the type
 * for which the explicit type is defined.
 */
interface HasTypeIndication
{
    /**
     * Reference to type definition.
     *
     * @return TypeDefinition
     */
    public function getTypeDefinition(): TypeDefinition;

    /**
     * Returns a Boolean value that indicates that the type
     * reference is a child of the List type.
     *
     * @return bool
     */
    public function isList(): bool;

    /**
     * Returns a Boolean value that indicates that
     * the type reference is a NonNull type.
     *
     * @return bool
     */
    public function isNonNull(): bool;

    /**
     * Returns a Boolean value that indicates that
     * the type reference is a NonNull + List type.
     *
     * @return bool
     */
    public function isListOfNonNulls(): bool;
}
