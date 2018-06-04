<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Context;

use Railt\SDL\Compiler\Common\ProvidesFile;
use Railt\SDL\Compiler\Common\ProvidesName;

/**
 * Interface LocalContextInterface
 */
interface LocalContextInterface extends ContextInterface, ProvidesFile, ProvidesName
{
    /**
     * @return ContextInterface
     */
    public function previous(): ContextInterface;
}
