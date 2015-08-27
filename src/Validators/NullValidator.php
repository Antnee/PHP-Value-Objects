<?php
namespace PVO\Validators;

class NullValidator implements Validator {
    
    public function validate($value)
    {
        return true;
    }
}
