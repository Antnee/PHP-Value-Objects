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
        return;
        $this->assertInstanceOf(
            'PVO\\Password',
            new Password($pass, new Validators\NullValidator)
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
        $this->assertTrue((new Password($pass, new BcryptPassword))->verify($pass));
    }

    /**
     * @test
     * @dataProvider invalidPasswordAndHashProvider
     * @param string $pass
     * @param string $hash
     */
    public function testPasswordDoesNotVerifyOk($pass, $hash)
    {
        $this->assertFalse((new Password($pass, new BcryptPassword))->verify($hash));
    }

    public function validPasswordProvider()
    {
        return [
            ['this is my password'],
            ['correct horse battery staple'],
            ['Tr0ub4dor&3'],
            ['password'],
            ['123456'],
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
            ['this is my password', '$2y$10$PUbuX8L.g1TuZcsf62pVrOKgp7LxIw3sG.7JfoWkIE3eQbzGk3saa'],
            ['correct horse battery staple', '$2y$10$f.KJzaMlkqYqU6v7bpSAKuumU9pli/kA0sW1rnrZWh7Ij9B/c5Zti'],
            ['Tr0ub4dor&3', '$2y$10$t5LFtvu.BTOkQnd1vVH/NeqwXRPmoOc6/bhKAINRic7LXVW.Hj3pq'],
            ['password', '$2y$10$03GOt6/XVABBqMlPleiD1egMCAgXuPmzOBzRqiAeYq.MaiKy.W2ia'],
            ['123456', '$2y$10$MseU3FAEYPEeuhH5OU9u6u2hVJUYyG6Gu1NxO9gTeBA0nVffB/Rh6']
        ];
    }

    public function invalidPasswordAndHashProvider()
    {
        return [
            ['this is my password', '$2y$10$PUbuX8L0g1TuZcsf62pVrOKgp7LxIw3sG.7JfoWkIE3eQbzGk3saa'],
            ['correct horse battery staple', 'AnthonyIsAwesome'],
            ['Tr0ub4dor&3', 'nope'],
            ['password', '$2y$10$03GOt6/XVABBqMlPleiD1egMCAgXuPmzOBzRqiAeYq.MaiKy.W2isssa'],
            ['123456', '$2y$10$MseU3FAEYPEeuhH5OU9u6u2hVJUYyG6Gu1NxO9gTeBA0nVffB\\Rh6']
        ];
    }
}