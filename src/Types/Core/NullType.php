<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\TypedGenerators\Types\Core;

use Iterator;
use loophp\TypedGenerators\Types\TypeGenerator;
use TypeError;

/**
 * @implements TypeGenerator<null>
 */
final class NullType implements TypeGenerator
{
    public function __invoke()
    {
        return null;
    }

    /**
     * @return Iterator<int, null>
     */
    public function getIterator(): Iterator
    {
        // @phpstan-ignore-next-line
        while (true) {
            yield $this->__invoke();
        }
    }

    /**
     * @param mixed $input
     *
     * @return null
     */
    public function identity($input)
    {
        if (null !== $input) {
            throw new TypeError('Invalid type');
        }

        return $input;
    }

    public static function new(): self
    {
        return new self();
    }
}
