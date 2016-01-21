<?php
namespace PVO;

/**
 * ID PHP Value Object
 * 
 * @package PHP Value Objects (PVO)
 * @author Anthony Chambers <pvo@anthonychambers.co.uk>
 */
class Id implements Interfaces\Pvo {
    private $value, $validator;
    
    /**
     * Immutable ID Constructor
     * 
     * @param string $value The value that you want to set as the ID
     * @param \PVO\Validator $validator The validator class that you wish to use. Will default to check for positive integer only if none provided
     * @throws Exceptions\InvalidValueException If validation fails
     */
    public function __construct($value, Validators\Interfaces\Validator $validator=null)
    {
        if (is_null($validator)) {
            $validator = new Validators\Id\PositiveInteger;
        }
        $this->validator = $validator;
        try {
            $this->validator->validate($value);
        } catch (Exceptions\InvalidValueException $e) {
            throw new Exceptions\InvalidValueException("Value is not a valid ID", 999, $e);
        }
        $this->value = $value;
    }
    
    /**
     * Get Id
     * @return string
     */
    public function get()
    {
        return $this->value;
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