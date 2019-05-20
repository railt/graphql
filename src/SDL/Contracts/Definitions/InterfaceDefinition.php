<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Contracts\Definitions;

use Railt\SDL\Contracts\Dependent\Field\HasFields;
use Railt\SDL\Contracts\Invocations\Directive\HasDirectives;

/**
 * Interface InterfaceDefinition
 */
interface InterfaceDefinition extends TypeDefinition, HasFields, HasDirectives
{
}
