<?php
namespace PVO\Interfaces;

interface Password {
    public function verify($password, $opts=[]);
}
