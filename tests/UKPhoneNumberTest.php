<?php
namespace PVO;

class UKPhoneNumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider validUKPhoneNumberProvider
     * @param string $number
     */
    public function testValidUKPhoneNumber($number)
    {
        $this->assertInstanceOf('PVO\\PhoneNumber', new PhoneNumber($number, new Validators\PhoneNumber\UkPhoneNumber));
    }
    
    /**
     * @test
     * @dataProvider invalidUKPhoneNumberProvider
     * @param string $number
     * @expectedException \PVO\Exceptions\InvalidValueException
     */
    public function testInvalidUKPhoneNumber($number)
    {
        new PhoneNumber($number, new Validators\PhoneNumber\UkPhoneNumber);
    }
    
    public function validUKPhoneNumberProvider()
    {
        return [
            ['01234567890'],
            ['+441234567890'],
            ['01234 567890'],
            ['+44 1234 567890'],
            ['(01234) 567890'],
        ];
    }
    
    public function invalidUKPhoneNumberProvider()
    {
        return [
            ['this is not a phone number'],
            ['1234567890'],
            ['00441234567890'],
            ['+44 (0) 1234 567890'],
        ];
    }
}