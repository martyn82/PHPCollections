<?php
namespace Collections;

class HashSet implements Set {
    private $type;
    private $list;
    
    public function __construct( \String $type ) {
        $this->type = $type;
        $this->list = array();
    }
    
    private function requiresType( $item ) {
        if ( !is_object( $item ) || get_class( $item ) != $this->type ) {
            $type = is_object( $item ) ? get_class( $item ) : gettype( $item );
            throw new \InvalidArgumentException( $type . ' is not compatible with type ' . $this->type );
        }
    }
    
    public function add( $item ) {
        $this->requiresType( $item );
        $this->list[ serialize( $item ) ] = $item;
    }
    
    public function addAll( Collection $collection ) {
        foreach ( $collection->iterator() as $item ) {
            $this->add( $item );
        }
    }
    
    public function clear() {
        $this->list = array();
    }
    
    public function contains( $item ) {
        $this->requiresType( $item );
        return array_key_exists( serialize( $item ), $this->list ) !== false;
    }
    
    public function containsAll( Collection $collection ) {
        foreach ( $collection->iterator() as $item ) {
            if ( !$this->contains( $item ) ) {
                return false;
            }
        }
    
        return true;
    }
    
    public function isEmpty() {
        return empty( $this->list );
    }
    
    public function iterator() {
        return new \ArrayIterator( $this->list );
    }
    
    public function remove( $item ) {
        $index = serialize( $item );
        
        if ( isset( $this->list[ $index ] ) ) {
            unset( $this->list[ $index ] );
        }
    }
    
    public function removeAll( Collection $collection ) {
        foreach ( $collection->iterator() as $item ) {
            $this->remove( $item );
        }
    }
    
    public function retainAll( Collection $collection ) {
        $array = $collection->toArray();
        $this->list = array_intersect( $this->list, $array );
    }
    
    public function size() {
        return count( $this->list );
    }
    
    public function toArray() {
        return array_values( $this->list );
    }
}