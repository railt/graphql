<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Builder;

use Railt\SDL\Ast\Type\NamedTypeNode;
use GraphQL\TypeSystem\Type\UnionType;
use Railt\SDL\Ast\Generic\UnionTypesCollection;
use GraphQL\Contracts\TypeSystem\Type\TypeInterface;
use Railt\SDL\Ast\Definition\UnionTypeDefinitionNode;
use GraphQL\Contracts\TypeSystem\DefinitionInterface;
use GraphQL\Contracts\TypeSystem\Type\UnionTypeInterface;

/**
 * @property UnionTypeDefinitionNode $ast
 */
class UnionTypeBuilder extends TypeBuilder
{
    /**
     * @return UnionTypeInterface|DefinitionInterface
     * @throws \RuntimeException
     */
    public function build(): UnionTypeInterface
    {
        $union = new UnionType([
            'name'        => $this->ast->name->value,
            'description' => $this->value($this->ast->description),
        ]);

        $this->register($union);

        if ($this->ast->types) {
            $union = $union->withTypes($this->buildTypes($this->ast->types));
        }

        return $union;
    }

    /**
     * @param UnionTypesCollection|NamedTypeNode[]|null $types
     * @return \Traversable|TypeInterface[]
     */
    protected function buildTypes(?UnionTypesCollection $types): \Traversable
    {
        foreach ($types as $type) {
            yield $this->fetch($type->name->value);
        }
    }
}
