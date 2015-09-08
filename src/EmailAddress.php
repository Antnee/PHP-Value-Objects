<?php
namespace PVO;

/**
 * EmailAddress PHP Value Object
 * 
 * @package PHP Value Objects (PVO)
 * @author Anthony Chambers <pvo@anthonychambers.co.uk>
 */
class EmailAddress implements Interfaces\Pvo{
    private $value;
    
    /**
     * Immutable EmailAddress Constructor
     * 
     * @param string $value The value that you want to set as the email address
     * @param \PVO\Validator $validator The validator class that you wish to use. Will default to basic internal email validator if none provided
     * @throws Exceptions\InvalidValueException If validation fails
     */
    public function __construct($value, Validators\Interfaces\Validator $validator=null)
    {
        if (is_null($validator)) {
            $validator = new Validators\Email;
        }
        try {
            $validator->validate($value);
        } catch (Exceptions\ValidationException $e) {
            throw new Exceptions\InvalidValueException("Value is not a valid email address", 999, $e);
        }
        $this->value = $value;
    }
    
    /**
     * Get Email Address
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