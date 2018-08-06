<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Compiler\Ast\Dependent;

use Railt\Parser\Ast\NodeInterface;
use Railt\Parser\Ast\Rule;
use Railt\SDL\Compiler\Ast\Common\DescriptionProvider;
use Railt\SDL\Compiler\Ast\Common\DirectivesProvider;
use Railt\SDL\Compiler\Ast\TypeHintNode;
use Railt\SDL\Compiler\Ast\Value\BaseValueNode;

/**
 * Class InputFieldDefinitionNode
 */
class InputFieldDefinitionNode extends Rule
{
    use DirectivesProvider;
    use DescriptionProvider;

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->first('T_NAME', 1)->getValue();
    }

    /**
     * @return null|TypeHintNode|NodeInterface
     */
    public function getTypeHint(): TypeHintNode
    {
        return $this->first('TypeHint', 1);
    }

    /**
     * @return null|BaseValueNode|NodeInterface
     */
    public function getDefaultValue(): ?BaseValueNode
    {
        return $this->first('Value', 1);
    }
}
