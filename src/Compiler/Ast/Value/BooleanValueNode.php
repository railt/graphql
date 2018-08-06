<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Ast\Value;

/**
 * Class BooleanValueNode
 */
class BooleanValueNode extends BaseValueNode
{
    /**
     * @return bool
     */
    public function toPrimitive(): bool
    {
        return $this->getChild(0)->getValue() === 'true';
    }
}
