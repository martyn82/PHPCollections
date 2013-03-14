<?php
class String extends Object {
    private $value;
    
    public function __construct( $value ) {
        $this->value = (string) $value;
    }
    
    public function value() {
        return $this->value;
    }
    
    public function __toString() {
        return $this->value;
    }
}