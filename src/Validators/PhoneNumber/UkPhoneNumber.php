<?php
namespace PVO\Validators\PhoneNumber;

use PVO\Exceptions;

class UkPhoneNumber extends PhoneNumber {
    private $validRegex = '/^(\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3}$/';
    private $removeRegex = ['/\+44/', '/[^\d]/'];
    private $replaceRegex = ['0', ''];
    
    public function validate($value)
    {
        if (false == preg_match($this->validRegex, $value)){
            throw new Exceptions\InvalidValueException;
        }
        return true;
    }
    
    public function getInternational($value)
    {
        $val = $this->validate($this->sanitise($value));
        return '+44'.$val;
    }
    
    public function sanitise($value)
    {
        return preg_replace($this->removeRegex, $this->replaceRegex, $value);
    }
}
