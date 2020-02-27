<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\GraphQL\AST\Definition;

use Railt\GraphQL\AST\Common\ImplementInterfaces;
use Railt\GraphQL\AST\Node;
use Railt\GraphQL\AST\Proxy\DescriptionProxyTrait;
use Railt\GraphQL\AST\Proxy\DirectiveProxyTrait;
use Railt\GraphQL\AST\Proxy\NameProxyTrait;

/**
 * @internal This type is generated using a parser, please do not use it inside your application code.
 */
class ObjectNode extends Node
{
    use NameProxyTrait;
    use DirectiveProxyTrait;
    use DescriptionProxyTrait;

    /**
     * @var array|FieldNode[]
     */
    public $fields = [];

    /**
     * @var array|string[]
     */
    public $interfaces = [];

    /**
     * @param mixed $value
     * @return bool
     */
    protected function each($value): bool
    {
        if ($value instanceof ImplementInterfaces) {
            $this->interfaces = $value->interfaces;

            return true;
        }

        if ($value instanceof FieldNode) {
            $this->fields[] = $value;

            return true;
        }

        return parent::each($value);
    }
}
