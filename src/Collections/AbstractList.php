<?php
namespace Collections;

abstract class AbstractList extends AbstractCollection implements IList {
	/**
	 * @see IList::addAt()
	 */
	public function addAt( $index, $element ) {
		$index = $this->validateIndex( $index );
		$tail = \array_slice( $this->elements, $index );
		$this->elements[ $index ] = $element;

		foreach ( $tail as $nextElement ) {
			$this->elements[ ++$index ] = $nextElement;
		}

		return true;
	}

	/**
	 * @see IList::addAllAt()
	 */
	public function addAllAt( $index, Collection $elements ) {
		$index = $this->validateIndex( $index );
		$tail = \array_slice( $this->elements, $index );

		foreach ( $elements->toArray() as $newElement ) {
			$this->elements[ $index++ ] = $newElement;
		}

		foreach ( $tail as $nextElement ) {
			$this->elements[ $index++ ] = $nextElement;
		}

		return true;
	}

	/**
	 * @see IList::get()
	 */
	public function get( $index ) {
		$index = $this->validateIndex( $index );
		return $this->elements[ $index ];
	}

	/**
	 * @see IList::getIteratorAt()
	 */
	public function getIteratorAt( $index ) {
		$index = $this->validateIndex( $index );
		$iterator = $this->getIterator();

		for ( $i = 0; $i < $index; $i++ ) {
			$iterator->next();
		}

		return $iterator;
	}

	/**
	 * @see IList::indexOf()
	 */
	public function indexOf( $element ) {
		$index = \array_search( $element, $this->elements );
		return (int) ( $index === false ? -1 : $index );
	}

	/**
	 * @see IList::lastIndexOf()
	 */
	public function lastIndexOf( $element ) {
		$reversed = \array_reverse( $this->elements, true );
		$index = \array_search( $element, $reversed );
		return (int) ( $index === false ? -1 : $index );
	}

	/**
	 * @see IList::removeAt()
	 */
	public function removeAt( $index ) {
		$index = $this->validateIndex( $index );
		$result = $this->elements[ $index ];

		unset( $this->elements[ $index ] );
		$this->elements = \array_values( $this->elements );

		return $result;
	}

	/**
	 * @see IList::set()
	 */
	public function set( $index, $element ) {
		$index = $this->validateIndex( $index );

		$result = $this->elements[ $index ];
		$this->elements[ $index ] = $element;

		return $result;
	}

	/**
	 * @see IList::subList()
	 */
	public function subList( $fromIndex, $toIndex ) {
		$fromIndex = (int) $fromIndex;
		$toIndex = (int) $toIndex;

		if ( $fromIndex < 0 || $toIndex > $this->size() ) {
			throw new \OutOfBoundsException( "The range is out of bounds of the list." );
		}

		if ( $fromIndex > $toIndex ) {
			throw new \InvalidArgumentException( "Left bound must not be larger than right bound." );
		}

		$portion = \array_slice( $this->elements, $fromIndex, $toIndex - $fromIndex );

		$subList = new static();
		$subList->elements = $portion;

		return $subList;
	}

	/**
	 * Validates the specified index for this list.
	 *
	 * @param integer $index
	 *
	 * @return integer
	 *
	 * @throws \OutOfBoundsException
	 */
	private function validateIndex( $index ) {
		$index = (int) $index;

		if ( $index < 0 || $index >= $this->size() ) {
			throw new \OutOfBoundsException( "List index out of bounds: '{$index}'." );
		}

		return $index;
	}
}
