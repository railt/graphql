<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL;

use Railt\Io\Readable;
use Railt\Reflection\Contracts\Document;
use Railt\SDL\IR\Definition;
use Railt\SDL\IR\DocumentDefinition;

/**
 * Interface CompilerInterface
 */
interface CompilerInterface
{
    /**
     * @param \Closure $then
     * @return CompilerInterface
     */
    public function autoload(\Closure $then): self;

    /**
     * @param Readable $readable
     * @return Document
     */
    public function compile(Readable $readable): Document;

    /**
     * @param Readable $readable
     * @return mixed|Definition|DocumentDefinition
     */
    public function ir(Readable $readable);

    /**
     * @param Readable $file
     * @param iterable $opcodes
     * @return Document
     */
    public function generate(Readable $file, $opcodes): Document;
}
