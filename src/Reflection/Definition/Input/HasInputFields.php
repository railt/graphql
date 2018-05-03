<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Definition\Input;

/**
 * Interface HasInputFields
 */
interface HasInputFields
{
    /**
     * @return iterable|InputFieldDefinition[]
     */
    public function getFields(): iterable;

    /**
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool;

    /**
     * @param string $name
     * @return null|InputFieldDefinition
     */
    public function getField(string $name): ?InputFieldDefinition;

    /**
     * @return int
     */
    public function getNumberOfFields(): int;
}
