<?php
namespace PVO\Validators\Password;

use PVO\Password;
use PVO\Exceptions;

/**
 * SHA1 Password Validator
 *
 * Please don't use this to create new passwords. Use something that is actually
 * cryptographically secure, like BcryptPassword, or DefaultPassword
 */
class Sha1Password extends DefaultPassword {

    public function validate($value)
    {
        if (false === is_string($value)){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }

    public function verify(Password $pass, $string)
    {
        return sha1($string) === $pass;
    }

    public function hash($string)
    {
        return sha1($string);
    }
}