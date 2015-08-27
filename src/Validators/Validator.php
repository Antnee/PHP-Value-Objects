<?php
namespace PVO\Validators;

interface Validator {
    /**
     * Validate
     * @param mixed $value
     * @throws PVO\Exceptions\ValidationException
     * @return bool If successful
     */
    public function validate($value);
}
