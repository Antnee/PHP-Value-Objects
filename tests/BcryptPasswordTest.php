<?php
namespace PVO;

use PVO\Validators\Password\BcryptPassword;

class BcryptPasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider validPasswordProvider
     * @param string $pass
     */
    public function testValidPassword($pass)
    {
        $this->assertInstanceOf('PVO\\Password', new Password($pass, new BcryptPassword));
    }
    
    /**
     * @test
     * @dataProvider invalidPasswordProvider
     * @param string $pass
     * @expectedException \PVO\Exceptions\InvalidValueException
     */
    public function testInvalidPassword($pass)
    {
        new Password($pass, new BcryptPassword);
    }
    
    /**
     * @test
     * @dataProvider invalidPasswordProvider
     * @param string $pass
     */
    public function testNullValidatorValidatesEverything($pass)
    {
        $this->assertInstanceOf(
            'PVO\\Pass',
            new Password($pass, new Validators\NullValidator)
        );
    }

    public function validPasswordProvider()
    {
        return [
            ['this is my password'],
            ['correct horse battery staple'],
            ['Tr0ub4dor&3'],
            ['password'],
            ['123456']
        ];
    }
    
    public function invalidPasswordProvider()
    {
        return [
            [NULL],
            [123456],
        ];
    }
}