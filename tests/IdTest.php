<?php
namespace PVO;

use PVO\Validators\NullValidator;

class IdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider validIntIdProvider
     * @param int id
     */
    public function testValidIntegerId($id)
    {
        $this->assertInstanceOf('PVO\\Id', new Id($id));
    }
    
    /**
     * @test
     * @dataProvider invalidIntIdProvider
     * @param int $id
     * @expectedException \PVO\Exceptions\InvalidValueException
     */
    public function testInvalidIntegerId($id)
    {
        new Id($id);
    }
    
    /**
     * @test
     * @dataProvider invalidIntIdProvider
     * @param int $id
     */
    public function testNullValidatorValidatesEverything($id)
    {
        $this->assertInstanceOf(
            'PVO\\Id',
            new Id($id, new NullValidator)
        );
    }

    public function validIntIdProvider()
    {
        return [
            [1],
            [100],
            [1321320132],
            [PHP_INT_MAX],
        ];
    }
    
    public function invalidIntIdProvider()
    {
        return [
            [0.2],
            [-5],
            [-99999999999999],
            ['A string'],
        ];
    }
}