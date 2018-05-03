<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler;

use Railt\Io\Readable;

/**
 * Interface Loader
 */
interface Loader
{
    /**
     * @param callable $then
     * @return Loader
     */
    public function addLoader(callable $then): Loader;

    /**
     * @param string $type
     * @return Readable
     */
    public function fetch(string $type): Readable;
}
