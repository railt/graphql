<?php
/**
 * This file is part of Railt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

namespace Railt\SDL\Ast\Support;

use Railt\Parser\Ast\RuleInterface;
use Railt\SDL\Ast\Value\StringValueNode;

/**
 * Trait DescriptionProvider
 */
trait DescriptionProvider
{
    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        $description = $this->first('Description', 1);

        if ($description instanceof RuleInterface) {
            /** @var StringValueNode $value */
            $value = $description->getChild(0);

            return $this->trim($value->toPrimitive());
        }

        return null;
    }

    /**
     * @param string $content
     * @return string
     */
    private function trim(string $content): string
    {
        $lines = \array_map(function(string $line): string {
            return \ltrim($line, '#');
        }, \explode("\n", $content));

        return \trim(\implode("\n", $lines), "\n\r");
    }
}
