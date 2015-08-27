<?php
namespace PVO;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider validEmailAddressProvider
     * @param string $email
     */
    public function testValidEmailAddress($email)
    {
        $this->assertInstanceOf('PVO\\EmailAddress', new EmailAddress($email));
    }
    
    /**
     * @test
     * @dataProvider invalidEmailAddressProvider
     * @param string $email
     * @expectedException \PVO\Exceptions\InvalidValueException
     */
    public function testInvalidEmailAddress($email)
    {
        new EmailAddress($email);
    }
    
    /**
     * @test
     * @dataProvider invalidEmailAddressProvider
     * @param string $email
     */
    public function testNullValidatorValidatesEverything($email)
    {
        $this->assertInstanceOf(
            'PVO\\EmailAddress',
            new EmailAddress($email, new Validators\NullValidator)
        );
    }
    
    /**
     * @test
     * @dataProvider validEmailAddressProvider
     * @param string $email
     */
    public function testEmailAddressEqualsConstructorParameter($email)
    {
        $this->assertEquals((new EmailAddress($email)), $email);
    }
    
    public function validEmailAddressProvider()
    {
        return [
            ['pvo@anthonychambers.co.uk'],
            ['pvo@anthonychambers.uk'],
            ['test@test.com'],
            ['test@test.museum'],
            ['firstname.lastname@test.arbitrarytld'],
        ];
    }
    
    public function invalidEmailAddressProvider()
    {
        return [
            ['this is not an email address'],
            ['i@u'],
            ['email@127.0.0.1'], // Arguably this IS a valid email address
        ];
    }
}