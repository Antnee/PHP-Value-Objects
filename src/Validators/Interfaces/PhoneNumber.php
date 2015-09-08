<?php
namespace PVO\Validators\Interfaces;

interface PhoneNumber {
    public function isMobile($value);
    public function getInternational($value);
    public function getStd($value);
}
