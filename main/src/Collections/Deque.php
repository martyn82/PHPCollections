<?php
namespace Collections;

interface Deque extends Collection, Queue {
	/**
	 * Inserts the specified element at the front of this deque.
	 *
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> if the element was added to this deque, <code>false</code> otherwise.
	 */
	function addFirst( $element );

	/**
	 * Inserts the specified element at the end of this deque.
	 *
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> if the element was added to this deque, <code>false</code> otherwise.
	*/
	function addLast( $element );

	/**
	 * Returns an iterator over the elements in this deque in reverse sequential order. The elements will be returned in
	 * order from tail to head.
	 *
	 * @return \Iterator
	*/
	function getDescendingIterator();

	/**
	 * Retrieves, but does not remove, the first element of this deque. This method differs from <code>peekFirst</code>
	 * only in that it throws an exception if this deque is empty.
	 *
	 * @return mixed The head of this deque.
	 *
	 * @throws \UnderflowException
	*/
	function getFirst();

	/**
	 * Retrieves, but does not remove, the last element of this deque. This method differs from <code>peekLast</code>
	 * only in that it throws an exception if this deque is empty.
	 *
	 * @return mixed
	 *
	 * @throws \UnderflowException
	*/
	function getLast();

	/**
	 * Retrieves, but does not remove, the first element of this deque, or returns <code>null</code> if this deque is
	 * empty.
	 *
	 * @return mixed
	*/
	function peekFirst();

	/**
	 * Retrieves, but does not remove, the last element of this deque, or returns <code>null</code> if this deque is
	 * empty.
	 *
	 * @return mixed
	*/
	function peekLast();

	/**
	 * Retrieves and removes the first element of this deque. This method differs from <code>pollFirst</code> only in
	 * that it throws an exception if this deque is empty.
	 *
	 * @return mixed
	 *
	 * @throws \UnderflowException
	*/
	function removeFirst();

	/**
	 * Retrieves and removes the last element of this deque. This method differs from <code>pollLast</code> only in that
	 * it throw an exception if this deque is empty.
	 *
	 * @return mixed
	 *
	 * @throws \UnderflowException
	*/
	function removeLast();

	/**
	 * Retrieves and removes the first element of this deque, or returns <code>null</code> if this deque is empty.
	 *
	 * @return mixed
	*/
	function pollFirst();

	/**
	 * Retrieves and removes the last element of this deque, or returns <code>null</code> if this deque is empty.
	 *
	 * @return mixed
	*/
	function pollLast();
}
