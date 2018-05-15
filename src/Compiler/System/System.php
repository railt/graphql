<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\System;

use Railt\SDL\Compiler\Record\RecordInterface;

/**
 * Class System
 */
abstract class System implements SystemInterface
{
    /**
     * @param RecordInterface $record
     * @return Comparator
     */
    protected function when(RecordInterface $record): Comparator
    {
        return new Comparator($record);
    }
}