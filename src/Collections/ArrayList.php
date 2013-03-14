<?php
namespace Collections;

class ArrayList implements IList {
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
        $this->list[] = $item;
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
        return array_search( $item, $this->list ) !== false;
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
        $index = $this->indexOf( $item );
        
        if ( is_int( $index ) ) {
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
        return $this->list;
    }
    
    public function get( \Integer $index ) {
        $index = $index->value();
        
        if ( isset( $this->list[ $index ] ) ) {
            return $this->list[ $index ];
        }
        
        return null;
    }
    
    public function indexOf( $item ) {
        $this->requiresType( $item );
        $index = array_search( $item, $this->list );
        return $index !== false ? $index : null;
    }
    
    public function lastIndexOf( $item ) {
        $this->requiresType( $item );
        
        for ( $i = count( $this->list ) - 1; $i > -1; $i-- ) {
            if ( $item == $this->list[ $i ] ) {
                return $i;
            }
        }
        
        return null;
    }
    
    public function listIterator( \Integer $index = null ) {
        $index = $index == null ? 0 : $index->value();
        return new \ArrayIterator( array_slice( $this->list, $index ) );
    }
    
    public function set( \Integer $index, $item ) {
        $this->requiresType( $item );
        $index = $index->value();
        $this->list[ $index ] = $item;
    }
    
    public function subList( \Integer $fromIndex, \Integer $toIndex ) {
        $fromIndex = $fromIndex->value();
        $toIndex = $toIndex->value();
        
        $instance = new self( $this->type );
        $instance->list = array_slice( $this->list, $fromIndex, ( $this->size() - $toIndex - 1 ) );
        return $instance;
    }
}