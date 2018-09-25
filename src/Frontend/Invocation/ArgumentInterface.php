<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\Reflection\Invocation;

/**
 * Interface ArgumentInterface
 */
interface ArgumentInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed|ArgumentInterface|TypeInvocation
     */
    public function getValue();
}
