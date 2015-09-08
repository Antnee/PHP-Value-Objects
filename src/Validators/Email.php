<?php
namespace PVO\Validators;

use PVO\Exceptions;

class Email implements Interfaces\Validator {
    
    public function validate($value)
    {
        if (false === filter_var($value, FILTER_VALIDATE_EMAIL)){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }
}
