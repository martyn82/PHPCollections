<?php
class Boolean extends Object {
    private $value;
    
    public function __construct( $value ) {
        $this->value = (bool) $value;
    }
    
    public function value() {
        return $this->value;
    }
}