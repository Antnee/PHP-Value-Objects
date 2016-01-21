<?php
namespace PVO\Validators;

class NullValidator implements Interfaces\Validator {
    
    public function validate($value)
    {
        return true;
    }

    public function __call()
    {
        return true;
    }
}
