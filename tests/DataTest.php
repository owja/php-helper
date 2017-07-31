<?php
declare(strict_types=1);

namespace Owja\Helper\test;

use Owja\Helper\Data;
use PHPUnit\Framework\TestCase;

/**
 * @covers Data
 */
final class DataTest extends TestCase
{
    protected $example = [
        'example' => [
            'value' => 'test',
        ]
    ];

    public function __construct()
    {
        parent::__construct();

        $this->example['object'] = new Class {
            public $public_var = 'public_var';
            public $public_getter = 'public_var';
            public function getPublicGetter() {
                return 'public_getter';
            }
            protected $protectedSample = 'protected_var';
            protected function getProtectedGetter() {
                return 'protected_getter';
            }
        };
    }

    protected function data()
    {
        return new Data($this->example);
    }

    public function testMustBeExpected()
    {
        $this->assertEquals(
            'test',
            $this->data()->get('example.value')
        );

        $this->assertEquals(
            'public_var',
            $this->data()->get('object.public_var')
        );

        $this->assertEquals(
            'public_getter',
            $this->data()->get('object.public_getter')
        );

        $this->assertEquals(
            null,
            $this->data()->get('object.protected_getter')
        );

        $this->assertEquals(
            null,
            $this->data()->get('object.protected_var')
        );
    }

    public function testMustBeNull()
    {
        $this->assertEquals(
            null,
            $this->data()->get('example.value2')
        );

        $this->assertEquals(
            null,
            $this->data()->get('object.does.not.exist')
        );
    }

    public function testMustBeArray()
    {
        $this->assertArraySubset(
            $this->example['example'],
            $this->data()->get('example')
        );
    }
}
