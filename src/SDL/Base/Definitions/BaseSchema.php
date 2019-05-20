<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Base\Definitions;

use Railt\SDL\Base\Invocations\Directive\BaseDirectivesContainer;
use Railt\SDL\Contracts\Definitions\ObjectDefinition;
use Railt\SDL\Contracts\Definitions\SchemaDefinition;
use Railt\SDL\Contracts\Type;

/**
 * Class BaseSchema
 */
abstract class BaseSchema extends BaseTypeDefinition implements SchemaDefinition
{
    use BaseDirectivesContainer;

    /**
     * Schema type name
     */
    protected const TYPE_NAME = Type::SCHEMA;

    /**
     * Default schema name
     */
    protected const DEFAULT_SCHEMA_NAME = 'DefaultSchema';

    /**
     * @var ObjectDefinition
     */
    protected $query;

    /**
     * @var ObjectDefinition|null
     */
    protected $mutation;

    /**
     * @var ObjectDefinition|null
     */
    protected $subscription;

    /**
     * @return ObjectDefinition
     */
    public function getQuery(): ObjectDefinition
    {
        return $this->query;
    }

    /**
     * @return null|ObjectDefinition
     */
    public function getMutation(): ?ObjectDefinition
    {
        return $this->mutation;
    }

    /**
     * @return bool
     */
    public function hasMutation(): bool
    {
        return $this->mutation instanceof ObjectDefinition;
    }

    /**
     * @return null|ObjectDefinition
     */
    public function getSubscription(): ?ObjectDefinition
    {
        return $this->subscription;
    }

    /**
     * @return bool
     */
    public function hasSubscription(): bool
    {
        return $this->subscription instanceof ObjectDefinition;
    }

    /**
     * @return array
     */
    public function __sleep(): array
    {
        return \array_merge(parent::__sleep(), [
            // self class
            'query',
            'mutation',
            'subscription',

            // trait HasDirectives
            'directives',
        ]);
    }
}
