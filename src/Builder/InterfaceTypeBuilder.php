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
use GraphQL\Contracts\TypeSystem\Type\InterfaceTypeInterface;
use Railt\SDL\Ast\Definition\InterfaceTypeDefinitionNode;
use Railt\SDL\Builder\Common\FieldsBuilderTrait;
use Railt\TypeSystem\Type\InterfaceType;

/**
 * @property InterfaceTypeDefinitionNode $ast
 */
class InterfaceTypeBuilder extends TypeBuilder
{
    use FieldsBuilderTrait;

    /**
     * @return DefinitionInterface|InterfaceTypeInterface
     */
    public function build(): InterfaceTypeInterface
    {
        $interface = new InterfaceType([
            'name' => $this->ast->name->value,
        ]);

        $this->registerType($interface);

        $interface->description = $this->value($this->ast->description);
        $interface->fields = \iterator_to_array($this->buildFields($this->ast->fields));
        $interface->interfaces = \iterator_to_array($this->buildImplementedInterfaces($this->ast->interfaces));

        return $interface;
    }
}
