<?php
class Integer extends Object {
    private $value;
    
    public function __construct( $value ) {
        $this->value = (int) $value;
    }
    
    public function value() {
        return $this->value;
    }
}