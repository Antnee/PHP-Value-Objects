<?php
namespace PVO\Interfaces;

interface PhoneNumber {
    public function isMobile();
    public function getInternational();
    public function getStd();
}
