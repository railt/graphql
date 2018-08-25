<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Frontend\AST\Support;

use Railt\Parser\Ast\RuleInterface;
use Railt\SDL\Frontend\AST\Invocation\StringValueNode;
use Railt\SDL\Frontend\IR\Value\NullValue;
use Railt\SDL\Frontend\IR\Value\StringValue;
use Railt\SDL\Frontend\IR\Value\ValueInterface;

/**
 * Trait DescriptionProvider
 */
trait DescriptionProvider
{
    /**
     * @return null|RuleInterface
     */
    protected function getDescriptionNode(): ?RuleInterface
    {
        return $this->first('Description', 1);
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        $description = $this->getDescriptionNode();

        if ($description instanceof RuleInterface) {
            /** @var StringValueNode $value */
            $value = $description->getChild(0);

            return $this->trim($value->toPHPString());
        }

        return null;
    }

    /**
     * @return ValueInterface
     */
    protected function getDescriptionValue(): ValueInterface
    {
        $description = $this->getDescriptionNode();

        if ($description instanceof RuleInterface) {
            return new StringValue($this->getDescription(), $description->getOffset());
        }

        return new NullValue($this->getOffset());
    }

    /**
     * @param string $content
     * @return string
     */
    private function trim(string $content): string
    {
        $lines = \array_map(function (string $line): string {
            return \ltrim($line, '#');
        }, \explode("\n", $content));

        return \trim(\implode("\n", $lines), "\n\r");
    }
}