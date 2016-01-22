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

    public function verify(Password $pass, $string, $opts=[])
    {
        if (isset($opts['CONSTANT_TIME_COMPARISON']) && $opts['CONSTANT_TIME_COMPARISON'] == true) {
            if (function_exists("hash_equals")) {
                return hash_equals((string)$pass, sha1($string));
            }
            trigger_error("Constant time password comparison requires PHP 5.6+", E_USER_WARNING);
        }
        return (string)$pass === sha1($string);
    }

    public function hash($string)
    {
        return sha1($string);
    }
}