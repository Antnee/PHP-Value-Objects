<?php
namespace PVO\Validators\PhoneNumber;

use PVO\Exceptions;
use PVO\Validators\Interfaces;

abstract class PhoneNumber implements Interfaces\Validator, Interfaces\PhoneNumber {
    
    public function validate($value)
    {
        if (false === is_int($value)){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }
    
    /**
     * Get Area Code/STD from value
     * @param string $value
     * @return string
     */
    public function getStd($value)
    {
        return substr($value, 0, 5);
    }
    
    /**
     * Check If Is A Mobile Number
     * @param string $value
     * @return boolean
     */
    public function isMobile($value)
    {
        return false;
    }
    
    /**
     * Get International Version of Number
     * @param string $value
     * @return string
     */
    public function getInternational($value)
    {
        return $value;
    }
}
