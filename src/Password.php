<?php
namespace PVO;

use PVO\Interfaces\Password as PasswordInterface;
use PVO\Validators\Interfaces\Validator;
use PVO\Validators\Password\DefaultPassword;

/**
 * Password PHP Value Object
 *
 * @package PHP Value Objects (PVO)
 * @author Anthony Chambers <pvo@anthonychambers.co.uk>
 */
class Password implements Interfaces\Pvo, PasswordInterface
{
    private $value, $validator;

    /**
     * Immutable Password Constructor
     *
     * @param string $value The value that you want to set as the password
     * @param \PVO\Validator $validator The validator class that you wish to use. Will default to DefaultPassword if none is provided
     * @throws Exceptions\InvalidValueException If validation fails
     */
    public function __construct($value, Validator $validator=null)
    {
        if (is_null($validator)) {
            $validator = new DefaultPassword;
        }
        $this->validator = $validator;
        try {
            $this->validator->validate($value);
        } catch (Exceptions\InvalidValueException $e) {
            throw new Exceptions\InvalidValueException("Value cannot be used as a password", 999, $e);
        }
        $this->value = $validator->hash($value);
    }

    /**
     * Verify Password
     *
     * Pass in a string and the validator will handle verifying that the string
     * matches the current password
     *
     * @param string $password
     * @return bool
     */
    public function verify($password)
    {
        return $this->validator->verify($this, $password);
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