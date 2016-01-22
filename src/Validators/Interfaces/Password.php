<?php
namespace PVO\Validators\Interfaces;

use PVO\Password as PW;

interface Password {
    public function verify(PW $pass, $string, $opts=[]);
    public function hash($string);
}
