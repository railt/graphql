<?php

/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\SDL\Ast\Extension;

use Railt\SDL\Ast\Generic\FieldDefinitionCollection;
use Railt\SDL\Ast\Generic\InterfaceImplementsCollection;

/**
 * Class ObjectTypeExtensionNode
 *
 * <code>
 *  export interface ObjectTypeExtensionNode {
 *      readonly kind: 'ObjectTypeExtension';
 *      readonly loc?: Location;
 *      readonly name: IdentifierNode;
 *      readonly interfaces?: ReadonlyArray<NamedTypeNode>;
 *      readonly directives?: ReadonlyArray<DirectiveNode>;
 *      readonly fields?: ReadonlyArray<FieldDefinitionNode>;
 *  }
 * </code>
 */
class ObjectTypeExtensionNode extends TypeExtensionNode
{
    /**
     * @var InterfaceImplementsCollection|null
     */
    public ?InterfaceImplementsCollection $interfaces = null;

    /**
     * @var FieldDefinitionCollection|null
     */
    public ?FieldDefinitionCollection $fields = null;
}
