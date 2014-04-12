<?php
namespace Collections;

interface Collection extends \IteratorAggregate {
	/**
	 * Adds the given element to the collection.
	 *
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> if the collection has changed as a result of the call.
	 */
	function add( $element );

	/**
	 * Adds all of the elements in the given collection to this collection.
	 *
	 * @param Collection $elements
	 *
	 * @return boolean <code>true</code> if this collection has changed as a result of the call.
	*/
	function addAll( Collection $elements );

	/**
	 * Removes all of the elements from this collection.
	*/
	function clear();

	/**
	 * Returns <code>true</code> if this collection contains the given element.
	 *
	 * @param mixed $element
	 *
	 * @return boolean
	*/
	function contains( $element );

	/**
	 * Returns <code>true</code> if this collection contains all of the elements in the specified collection.
	 *
	 * @param Collection $elements
	 *
	 * @return boolean
	*/
	function containsAll( Collection $elements );

	/**
	 * Returns <code>true</code> if this collection is empty.
	 *
	 * @return boolean
	*/
	function isEmpty();

	/**
	 * Returns an iterator over the elements of this collection.
	 *
	 * @see IteratorAggregate::getIterator()
	 *
	 * @return \Iterator
	*/
	function getIterator();

	/**
	 * Removes a single instance of the specified element from the collection, if it is present.
	 *
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> if the collection has changed as a result of the call.
	*/
	function remove( $element );

	/**
	 * Removes all of this collection's elements that are also contained in the specified collection. As a result, this
	 * collection will contain no elements in common with the specified collection.
	 *
	 * @param Collection $elements
	 *
	 * @return boolean <code>true</code> if this collection has changed as a result of the call.
	*/
	function removeAll( Collection $elements );

	/**
	 * Retains only the elements in this collection that are contained in the specified collection.
	 *
	 * @param Collection $elements
	 *
	 * @return boolean <code>true</code> if this collection has changed as a result of the call.
	*/
	function retainAll( Collection $elements );

	/**
	 * Returns the number of elements in this collection.
	 *
	 * @return integer
	*/
	function size();

	/**
	 * Returns an array containing all the elements in this collection.
	 *
	 * @return \ArrayObject
	*/
	function toArray();
}
