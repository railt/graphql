<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Component\SDL\Contracts\Processable;

use Railt\Component\SDL\Contracts\Definitions\Definition;
use Railt\Component\SDL\Contracts\Definitions\TypeDefinition;

/**
 * Interface ExtendDefinition
 */
interface ExtendDefinition extends Definition
{
    /**
     * @return TypeDefinition
     */
    public function getRelatedType(): TypeDefinition;
}
