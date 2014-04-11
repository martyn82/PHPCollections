<?php
namespace Collections;

interface Queue extends Collection {
	/**
	 * Retrieves, but does not remove, the head of the queue.
	 *
	 * @return mixed
	 *
	 * @throws \UnderflowException
	 */
	function front();

	/**
	 * Inserts the specified element into this queue.
	 *
	 * @param mixed $element
	 *
	 * @return boolean <code>true</code> on success.
	 *
	 * @throws \OverflowException
	*/
	function enqueue( $element );

	/**
	 * Retrieves and removes the head of this queue, or returns <code>null</code> if this queue is empty.
	 *
	 * @return mixed The head of this queue, or <code>null</code> if this queue is empty.
	*/
	function dequeue();
}
