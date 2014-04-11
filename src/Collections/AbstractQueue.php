<?php
namespace Collections;

abstract class AbstractQueue extends AbstractCollection implements Queue {
	/**
	 * @see AbstractCollection::add()
	 */
	public function enqueue( $element ) {
		return $this->add( $element );
	}

	/**
	 * @see Queue::dequeue()
	 */
	public function dequeue() {
		if ( $this->isEmpty() ) {
			return null;
		}

		return array_pop( $this->elements );
	}

	/**
	 * @see Queue::front()
	 */
	public function front() {
		if ( $this->isEmpty() ) {
			throw new \UnderflowException( "Queue is empty." );
		}

		return end( $this->elements );
	}
}
