<?php
namespace PVO;

interface PvoInterface {
    public function __construct($value, Validators\Validator $validator=null);
    public function get();
    public function __toString();
}
