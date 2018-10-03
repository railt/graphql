<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\IR\Definition;

/**
 * @property array|FieldDefinitionValueObject[] $fields
 * @property array|string[] $implements
 * @property array|ArgumentInvocationValueObject[] $directives
 */
class ObjectDefinitionValueObject extends TypeDefinitionValueObject
{
    /**
     * @var array
     */
    protected $attributes = [
        'fields'     => [],
        'implements' => [],
        'directives' => [],
    ];
}
