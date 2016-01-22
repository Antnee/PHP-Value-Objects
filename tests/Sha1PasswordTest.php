<?php
namespace PVO;

use PVO\Validators\NullValidator;
use PVO\Validators\Password\Sha1Password;

class Sha1PasswordTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider validPasswordProvider
     * @param string $pass
     */
    public function testValidPassword($pass)
    {
        $this->assertInstanceOf('PVO\\Password', new Password($pass, new Sha1Password));
    }
    
    /**
     * @test
     * @dataProvider invalidPasswordProvider
     * @param string $pass
     * @expectedException \PVO\Exceptions\InvalidValueException
     */
    public function testInvalidPassword($pass)
    {
        new Password($pass, new Sha1Password);
    }
    
    /**
     * @test
     * @dataProvider invalidPasswordProvider
     * @param string $pass
     */
    public function testNullValidatorValidatesEverything($pass)
    {
        $this->assertInstanceOf(
            'PVO\\Password',
            new Password($pass, new NullValidator)
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