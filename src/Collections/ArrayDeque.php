<?php
namespace Collections;

class ArrayDeque extends AbstractCollection implements Deque {
	/**
	 * @see Deque::addFirst()
	 */
	public function addFirst( $element ) {
		\array_unshift( $this->elements, $element );
		return true;
	}

	/**
	 * @see Deque::addLast()
	 */
	public function addLast( $element ) {
		\array_push( $this->elements, $element );
		return true;
	}

	/**
	 * @see Deque::getFirst()
	 */
	public function getFirst() {
		if ( $this->isEmpty() ) {
			throw new \UnderflowException( "The Deque is empty." );
		}

		return \reset( $this->elements );
	}

	/**
	 * @see Deque::getLast()
	 */
	public function getLast() {
		if ( $this->isEmpty() ) {
			throw new \UnderflowException( "The Deque is empty." );
		}

		return \end( $this->elements );
	}

	/**
	 * @see Deque::peekFirst()
	 */
	public function peekFirst() {
		if ( $this->isEmpty() ) {
			return null;
		}

		return $this->getFirst();
	}

	/**
	 * @see Deque::peekLast()
	 */
	public function peekLast() {
		if ( $this->isEmpty() ) {
			return null;
		}

		return $this->getLast();
	}

	/**
	 * @see Deque::removeFirst()
	 */
	public function removeFirst() {
		if ( $this->isEmpty() ) {
			throw new \UnderflowException( "The Deque is empty." );
		}

		return \array_shift( $this->elements );
	}

	/**
	 * @see Deque::removeLast()
	 */
	public function removeLast() {
		if ( $this->isEmpty() ) {
			throw new \UnderflowException( "The Deque is empty." );
		}

		return \array_pop( $this->elements );
	}

	/**
	 * @see Deque::pollFirst()
	 */
	public function pollFirst() {
		if ( $this->isEmpty() ) {
			return null;
		}

		return $this->removeFirst();
	}

	/**
	 * @see Deque::pollLast()
	 */
	public function pollLast() {
		if ( $this->isEmpty() ) {
			return null;
		}

		return $this->removeLast();
	}

	/**
	 * @see Deque::getDescendingIterator()
	 */
	public function getDescendingIterator() {
		return new \ArrayIterator( \array_reverse( $this->elements ) );
	}

	/**
	 * @see Queue::enqueue()
	 */
	public function enqueue( $element ) {
		return $this->addLast( $element );
	}

	/**
	 * @see Queue::dequeue()
	 */
	public function dequeue() {
		return $this->pollFirst();
	}

	/**
	 * @see Queue::front()
	 */
	public function front() {
		return $this->getFirst();
	}
}
