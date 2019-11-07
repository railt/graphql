<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Executor\Linker;

use Railt\SDL\Ast\DefinitionNode;
use Railt\SDL\Linker\LinkerInterface;
use Railt\SDL\Ast\Type\NamedTypeNode;
use Phplrt\Contracts\Ast\NodeInterface;
use Railt\SDL\Ast\Extension\EnumTypeExtensionNode;

/**
 * Class EnumTypeExtensionLinker
 */
class EnumTypeExtensionLinker extends TypeExtensionLinker
{
    /**
     * {@inheritDoc}
     */
    protected function match(NodeInterface $node): bool
    {
        return $node instanceof EnumTypeExtensionNode;
    }

    /**
     * {@inheritDoc}
     */
    protected function getLinkerType(): int
    {
        return LinkerInterface::LINK_ENUM_TYPE;
    }

    /**
     * {@inheritDoc}
     */
    protected function getErrorMessage(): string
    {
        return 'Enum type "%s" not found and could not be loaded';
    }

    /**
     * @param DefinitionNode|NamedTypeNode $type
     * @return bool
     */
    protected function exists(DefinitionNode $type): bool
    {
        return $this->registry->typeMap->containsKey($type->name->value) ||
            $this->document->typeMap->containsKey($type->name->value);
    }
}
