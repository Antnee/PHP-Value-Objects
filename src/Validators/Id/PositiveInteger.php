<?php
namespace PVO\Validators\Id;

use PVO\Exceptions;
use PVO\Validators\Interfaces;

class PositiveInteger implements Interfaces\Validator {

    public function validate($value)
    {
        if (false === is_int($value) || $value < 0){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }
}