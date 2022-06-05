<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\generators\Types\Core;

use loophp\generators\Types\Core\StringType;
use PHPUnit\Framework\TestCase;
use function ord;
use function strlen;

/**
 * @internal
 * @coversDefaultClass \loophp\generators
 */
final class StringTypeTest extends TestCase
{
    public function stringTypeProvider()
    {
        yield [
            'length' => false,
            'prefix' => false,
        ];

        yield [
            'length' => null,
            'prefix' => 'a',
        ];

        yield [
            'length' => 1,
            'prefix' => 'b',
        ];

        yield [
            'length' => 2,
            'prefix' => 'c',
        ];

        yield [
            'length' => 3,
            'prefix' => 'd',
        ];

        yield [
            'length' => 4,
            'prefix' => 'e',
        ];

        yield [
            'length' => 100,
            'prefix' => 'a',
        ];
    }

    /**
     * @dataProvider stringTypeProvider
     *
     * @param mixed $length
     * @param mixed $prefix
     */
    public function testConstructor($length, $prefix)
    {
        if ($length === $prefix) {
            $stringType = StringType::new()();
            $length = 1;
            $prefix = '';
        } else {
            $stringType = null === $length
                ? StringType::new(1, $prefix)()
                : StringType::new($length, $prefix)();

            self::assertStringStartsWith($prefix, $stringType);
        }

        self::assertEquals(($length ?? 1) + strlen($prefix), strlen($stringType));

        foreach (str_split($stringType) as $encoding) {
            self::assertGreaterThan(32, ord($encoding));
            self::assertLessThan(127, ord($encoding));
        }
    }
}
