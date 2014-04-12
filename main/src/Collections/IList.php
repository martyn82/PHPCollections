<?php
namespace Collections;

interface IList extends Collection {
	/**
	 * Appends the specified element to the end of this list.
	 *
	 * @param integer $index
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> if this list has changed as a result of the call.
	 *
	 * @throws \OutOfBoundsException
	 */
	function addAt( $index, $element );

	/**
	 * Inserts all the elements of the specified collection into this list at the specified position. Shifts the
	 * element (if any) and any subsequent elements to the right.
	 *
	 * @param integer $index
	 * @param Collection $elements
	 *
	 * @return boolean <code>true</code> if this list has changed as a result of the call.
	 *
	 * @throws \OutOfBoundsException
	*/
	function addAllAt( $index, Collection $elements );

	/**
	 * Returns the element at the specified position in this list.
	 *
	 * @param integer $index
	 *
	 * @return mixed
	 *
	 * @throws \OutOfBoundsException
	*/
	function get( $index );

	/**
	 * Returns the index of the first occurrence of the specified element in this list, or -1 if this list does not
	 * contain the element.
	 *
	 * @param mixed $element
	 *
	 * @return integer
	*/
	function indexOf( $element );

	/**
	 * Returns the index of the last occurrence of the specified element in this list, or -1 if this list does not
	 * contain the element.
	 *
	 * @param mixed $element
	 *
	 * @return integer
	*/
	function lastIndexOf( $element );

	/**
	 * Removes the element at specified position in this list. Shifts any subsequent elements to the left. Returns the
	 * element that was removed from the list.
	 *
	 * @param integer $index
	 *
	 * @return mixed
	 *
	 * @throws \OutOfBoundsException
	*/
	function removeAt( $index );

	/**
	 * Replaces the element at the specified position in this list with the specified element.
	 *
	 * @param integer $index
	 * @param mixed $element
	 *
	 * @return mixed The element previously at the specified position.
	 *
	 * @throws \OutOfBoundsException
	*/
	function set( $index, $element );

	/**
	 * Returns a view of the portion of this list between the specified <code>fromIndex</code> inclusive, and
	 * <code>toIndex</code> exclusive.
	 *
	 * @param integer $fromIndex
	 * @param integer $toIndex
	 *
	 * @return IList
	 *
	 * @throws \OutOfBoundsException
	 * @throws \InvalidArgumentException
	*/
	function subList( $fromIndex, $toIndex );

	/**
	 * Returns a list iterator over the elements in this list, in proper sequence, starting at the specified position
	 * in the list. The specified index indicates the first element that would be returned by an initial call to
	 * <code>next</code>.
	 *
	 * @param integer $index
	 *
	 * @return \Iterator
	*/
	function getIteratorAt( $index );
}
