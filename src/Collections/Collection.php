<?php
namespace Collections;

interface Collection {
    /**
     * Adds item to the collection.
     * 
     * @param mixed $item
     */
    function add( $item );
    
    /**
     * Adds all items in the collection to the collection.
     * 
     * @param Collection $collection
     */
    function addAll( Collection $collection );
    
    /**
     * Clears the collection.
     */
    function clear();
    
    /**
     * Determines whether the given item is in the collection.
     * 
     * @param mixed $item
     * 
     * @return boolean
     */
    function contains( $item );
    
    /**
     * Determines whether all items of the collection are in the collection.
     * 
     * @param Collection $collection
     * 
     * @return boolean
     */
    function containsAll( Collection $collection );
    
    /**
     * Determines whether the collection is empty.
     * 
     * @return boolean
     */
    function isEmpty();
    
    /**
     * Retrieves an iterator for the collection.
     * 
     * @return \Iterator
     */
    function iterator();
    
    /**
     * Removes the given item from the collection.
     * 
     * @param mixed $item
     */
    function remove( $item );
    
    /**
     * Removes all the items of the given collection from the collection.
     * 
     * @param Collection $collection
     */
    function removeAll( Collection $collection );
    
    /**
     * Modifies this collection and keeps all intersecting elements.
     * 
     * @param Collection $collection
     */
    function retainAll( Collection $collection );
    
    /**
     * Retrieves the number of items in the collection.
     * 
     * @return integer
     */
    function size();
    
    /**
     * Converts the collection to an array.
     * 
     * @return array
     */
    function toArray();
}