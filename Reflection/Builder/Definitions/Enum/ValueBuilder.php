<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Reflection\Builder\Definitions\Enum;

use Railt\Compiler\Ast\NodeInterface;
use Railt\SDL\Reflection\Builder\DocumentBuilder;
use Railt\SDL\Reflection\Builder\Invocations\Directive\DirectivesBuilder;
use Railt\SDL\Reflection\Builder\Process\Compilable;
use Railt\SDL\Reflection\Builder\Process\Compiler;
use Railt\Reflection\Base\Definitions\Enum\BaseValue;
use Railt\Reflection\Contracts\Definitions\EnumDefinition;

/**
 * Class ValueBuilder
 */
class ValueBuilder extends BaseValue implements Compilable
{
    use Compiler;
    use DirectivesBuilder;

    /**
     * ValueBuilder constructor.
     * @param NodeInterface $ast
     * @param DocumentBuilder $document
     * @param EnumDefinition $parent
     * @throws \Railt\SDL\Exceptions\TypeConflictException
     */
    public function __construct(NodeInterface $ast, DocumentBuilder $document, EnumDefinition $parent)
    {
        $this->parent = $parent;
        $this->boot($ast, $document);
    }
}
