<?php

/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Railt\SDL\Ast\Type;

/**
 * Class ListTypeNode
 *
 * <code>
 *  export interface ListTypeNode {
 *      readonly kind: 'ListType';
 *      readonly loc?: Location;
 *      readonly type: TypeNode;
 *  }
 * </code>
 */
class ListTypeNode extends TypeNode
{
    /**
     * @var TypeNode
     */
    public TypeNode $type;

    /**
     * ListTypeNode constructor.
     *
     * @param TypeNode $type
     */
    public function __construct(TypeNode $type)
    {
        $this->type = $type;
    }
}
