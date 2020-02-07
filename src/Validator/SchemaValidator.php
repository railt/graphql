<?php

/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\SDL\Validator;

use GraphQL\Contracts\TypeSystem\DefinitionInterface;

/**
 * Class SchemaValidator
 */
class SchemaValidator extends Factory
{
    public function assert(DefinitionInterface $type): void
    {
        throw new \LogicException(\sprintf('%s not implemented yet', __METHOD__));
    }
}