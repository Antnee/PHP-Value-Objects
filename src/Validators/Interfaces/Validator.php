<?php
namespace PVO\Validators\Interfaces;

interface Validator {
    /**
     * Validate
     * @param mixed $value
     * @throws PVO\Exceptions\ValidationException
     * @return bool If successful
     */
    public function validate($value);
}
