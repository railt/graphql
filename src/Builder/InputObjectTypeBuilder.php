<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Builder;

use GraphQL\Contracts\TypeSystem\DefinitionInterface;
use GraphQL\Contracts\TypeSystem\Type\InputTypeInterface;
use GraphQL\TypeSystem\Type\InputObjectType;
use Railt\SDL\Ast\Definition\InputObjectTypeDefinitionNode;

/**
 * @property InputObjectTypeDefinitionNode $ast
 */
class InputObjectTypeBuilder extends TypeBuilder
{
    /**
     * @return DefinitionInterface|InputTypeInterface
     */
    public function build(): InputTypeInterface
    {
        $input = new InputObjectType([
            'name'        => $this->ast->name->value,
            'description' => $this->value($this->ast->description),
        ]);

        $this->registerType($input);

        // TODO Add input arguments builder

        return $input;
    }
}
