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

    /**
     * @test
     * @dataProvider validPasswordAndHashProvider
     * @param string $pass
     * @param string $hash
     */
    public function testPasswordVerifiesOk($pass, $hash)
    {
        $this->assertTrue((new Password($pass, new Sha1Password))->verify($pass));
    }

    /**
     * @test
     * @dataProvider validPasswordAndHashProvider
     * @param string $pass
     * @param string $hash
     * @requires PHP 5.6
     */
    public function testPasswordVerifiesOkWithConstantTimeComparison($pass, $hash)
    {
        $this->assertTrue((new Password($pass, new Sha1Password))->verify($pass, ['CONSTANT_TIME_COMPARISON'=>true]));
    }

    /**
     * @test
     * @dataProvider invalidPasswordAndHashProvider
     * @param string $pass
     * @param string $hash
     */
    public function testPasswordDoesNotVerifyOk($pass, $hash)
    {
        $this->assertFalse((new Password($pass, new Sha1Password))->verify($hash));
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

    public function validPasswordAndHashProvider()
    {
        return [
            ['this is my password', '37b6f9b43749e598c58ba1b485c4fea38823fe42'],
            ['correct horse battery staple', 'abf7aad6438836dbe526aa231abde2d0eef74d42'],
            ['Tr0ub4dor&3', '874572e7a5ae6a49466a6ac578b98adba78c6aa6'],
            ['password', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8'],
            ['123456', '7c4a8d09ca3762af61e59520943dc26494f8941b']
        ];
    }

    public function invalidPasswordAndHashProvider()
    {
        return [
            ['this is my password', '$2y$10$PUbuX8L0g1TuZcsf62pVrOKgp7LxIw3sG.7JfoWkIE3eQbzGk3saa'],
            ['correct horse battery staple', 'AnthonyIsAwesome'],
            ['Tr0ub4dor&3', 'nope'],
            ['password', '5baa61e4c9b93f3g0682250b6cf8331b7ee68fd8'],
            ['123456', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8']
        ];
    }
}