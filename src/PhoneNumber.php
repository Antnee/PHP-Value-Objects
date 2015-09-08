<?php
namespace PVO;

/**
 * PhoneNumber PHP Value Object
 * 
 * @package PHP Value Objects (PVO)
 * @author Anthony Chambers <pvo@anthonychambers.co.uk>
 */
class PhoneNumber implements Interfaces\Pvo, Interfaces\PhoneNumber{
    private $value, $validator;
    
    /**
     * Immutable PhoneNumber Constructor
     * 
     * @param string $value The value that you want to set as the phone number
     * @param \PVO\Validator $validator The validator class that you wish to use. Will default to check for integer only if none provided
     * @throws Exceptions\InvalidValueException If validation fails
     */
    public function __construct($value, Validators\Interfaces\Validator $validator=null)
    {
        if (is_null($validator)) {
            $validator = new Validators\PhoneNumber\Generic;
        }
        $this->validator = $validator;
        try {
            $this->validator->validate($value);
        } catch (Exceptions\InvalidValueException $e) {
            throw new Exceptions\InvalidValueException("Value is not a valid phone number", 999, $e);
        }
        $this->value = $value;
    }
    
    /**
     * Get Phone Number
     * @return string
     */
    public function get()
    {
        return $this->value;
    }
    
    /**
     * Check whether number is mobile or not
     * @return bool
     */
    public function isMobile()
    {
        return $this->validator->isMobile($this->value);
    }
    
    /**
     * Get the international version of the phone number
     * @return string
     */
    public function getInternational()
    {
        return $this->validator->getInternational($this->value);
    }
    
    /**
     * Get the phone number's STD code
     * @return string
     */
    public function getStd()
    {
        return $this->validator->getStd($this->value);
    }
    
    /**
     * Allow object to be echoed as string
     * @return string
     */
    public function __toString()
    {
        return $this->get();
    }
}