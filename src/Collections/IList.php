<?php
namespace Collections;

interface IList extends Collection {
    /**
     * Retrieves the item at given index.
     * 
     * @param \Integer $index
     * 
     * @return mixed
     */
    function get( \Integer $index );
    
    /**
     * Retrieves the index of the given item.
     * 
     * @param mixed $item
     * 
     * @return integer
     */
    function indexOf( $item );
    
    /**
     * Retrieves the index of the last found item.
     * 
     * @param mixed $item
     * 
     * @return integer
     */
    function lastIndexOf( $item );
    
    /**
     * Retrieves a list iterator starting at given index.
     * 
     * @param \Integer $index
     * 
     * @return \Iterator
     */
    function listIterator( \Integer $index = null );
    
    /**
     * Sets the item at given index.
     * 
     * @param \Integer $index
     * @param mixed $item
     */
    function set( \Integer $index, $item );
    
    /**
     * Retrieves a sub list of the given range.
     * 
     * @param \Integer $fromIndex
     * @param \Integer $toIndex
     * 
     * @return IList
     */
    function subList( \Integer $fromIndex, \Integer $toIndex );
}