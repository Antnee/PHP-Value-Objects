<?php
namespace PVO\Validators\Password;

use PVO\Password;
use PVO\Exceptions;
use PVO\Validators\Interfaces;

class DefaultPassword implements Interfaces\Validator, Interfaces\Password {

    public function validate($value)
    {
        if (false === is_string($value)){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }

    public function verify(Password $pass, $string)
    {
        return password_verify($string, $pass);
    }

    public function hash($string)
    {
        return password_hash($string, PASSWORD_DEFAULT);
    }
}