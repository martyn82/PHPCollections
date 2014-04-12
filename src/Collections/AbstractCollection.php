<?php
namespace Collections;

abstract class AbstractCollection implements Collection {
	/**
	 * @var array
	 */
	protected $elements;

	/**
	 * Constructs a new collection instance.
	 */
	public function __construct() {
		$this->elements = array();
	}

	/**
	 * @see Collection::add()
	 */
	public function add( $element ) {
		$this->elements[] = $element;
		return true;
	}

	/**
	 * @see Collection::addAll()
	 */
	public function addAll( Collection $elements ) {
		$result = false;

		foreach ( $elements->toArray() as $element ) {
			$result = $this->add( $element ) || $result;
		}

		return $result;
	}

	/**
	 * @see Collection::clear()
	 */
	public function clear() {
		$this->elements = array();
	}

	/**
	 * @see Collection::contains()
	 */
	public function contains( $element ) {
		$index = array_search( $element, $this->elements, true );
		return $index !== false;
	}

	/**
	 * @see Collection::containsAll()
	 */
	public function containsAll( Collection $elements ) {
		return count( array_diff( $elements->toArray(), $this->elements ) ) == 0;
	}

	/**
	 * @see Collection::isEmpty()
	 */
	public function isEmpty() {
		return $this->size() == 0;
	}

	/**
	 * @see Collection::getIterator()
	 */
	public function getIterator() {
		return new \ArrayIterator( $this->elements );
	}

	/**
	 * @see Collection::remove()
	 */
	public function remove( $element ) {
		$index = array_search( $element, $this->elements, true );

		if ( $index === false ) {
			return false;
		}

		unset( $this->elements[ $index ] );
		$this->elements = array_values( $this->elements );
		return true;
	}

	/**
	 * @see Collection::removeAll()
	 */
	public function removeAll( Collection $elements ) {
		$result = false;

		foreach ( $elements->toArray() as $element ) {
			$result = $this->remove( $element ) || $result;
		}

		return $result;
	}

	/**
	 * @see Collection::retainAll()
	 */
	public function retainAll( Collection $elements ) {
		$newElements = array_values( array_intersect( $this->elements, $elements->toArray() ) );
		$result = $newElements != $this->elements;
		$this->elements = $newElements;
		return $result;
	}

	/**
	 * @see Collection::size()
	 */
	public function size() {
		return count( $this->elements );
	}

	/**
	 * @see Collection::toArray()
	 */
	public function toArray() {
		return $this->elements;
	}
}
