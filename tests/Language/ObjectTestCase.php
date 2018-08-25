<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Tests\SDL\Language;

use Railt\Reflection\Contracts\TypeInterface;
use Railt\Reflection\Type;

/**
 * Class ObjectTestCase
 */
class ObjectTestCase extends TypeDefinitionTestCase
{
    /**
     * @return string
     */
    protected function getSources(): string
    {
        return 'type A {}';
    }

    /**
     * @return string
     */
    protected function getTypeName(): string
    {
        return 'A';
    }

    /**
     * @return Type
     */
    protected function getType(): TypeInterface
    {
        return Type::of(Type::OBJECT);
    }
}