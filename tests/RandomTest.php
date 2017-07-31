<?php
declare(strict_types=1);

namespace Owja\Helper\test;

use Owja\Helper\Random;
use PHPUnit\Framework\TestCase;

/**
 * @covers Data
 */
final class RandomTest extends TestCase
{
    final public function testLengthMustBeExpected()
    {
        $this->assertEquals(
            128,
            strlen((string) new Random(128))
        );
    }

    final public function testShouldNotBeEqual()
    {
        $this->assertNotEquals(
            (string) new Random(128),
            (string) new Random(128)
        );

        $rnd =  new Random();

        $this->assertNotEquals(
            $rnd->generate(128),
            $rnd->generate(128)
        );
    }

    final public function testShouldBeEqual()
    {
        $this->assertEquals(
            (string) new Random(128, 'X'),
            (string) new Random(128, 'X')
        );

        $rnd =  new Random();

        $this->assertEquals(
            $rnd->generate(128, 'X'),
            $rnd->generate(128, 'X')
        );
    }

    final public function testConst()
    {
        $this->assertEquals(
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            Random::ALNUM
        );

        $this->assertEquals(
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            Random::ALPHA
        );

        $this->assertEquals(
            '0123456789abcdef',
            Random::HEX
        );

        $this->assertEquals(
            '0123456789',
            Random::NUMBERS
        );
    }

    final public function testExceptionLengthNull()
    {
        $this->expectException(\Exception::class);
        new Random(0);
    }

    final public function testExceptionPoolEmpty()
    {
        $this->expectException(\Exception::class);
        new Random(128, '');
    }

    final public function testExceptionNoTokenGenerated()
    {
        $this->expectException(\Exception::class);
        $rnd = new Random();
        $rnd->getToken();
    }
}
