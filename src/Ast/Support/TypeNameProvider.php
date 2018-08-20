<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Ast\Support;

use Railt\Parser\Ast\NodeInterface;
use Railt\SDL\Ast\Common\TypeNameNode;

/**
 * Trait TypeNameProvider
 */
trait TypeNameProvider
{
    /**
     * @return null|TypeNameNode|NodeInterface
     */
    protected function getTypeNameNode(): ?TypeNameNode
    {
        return $this->first('TypeName', 1);
    }

    /**
     * @return null|string
     */
    public function getFullName(): ?string
    {
        $name = $this->getTypeNameNode();

        if ($name instanceof TypeNameNode) {
            return $name->getFullName();
        }

        return null;
    }
}
