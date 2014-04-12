<?php
namespace Collections\Map;

use Collections\AbstractSet;

class EntrySet extends AbstractSet {
	/**
	 * @see AbstractSet::add()
	 */
	public function add( $element ) {
		return $this->_add( $element );
	}

	/**
	 * Type-safe add.
	 *
	 * @param Entry $element
	 *
	 * @return boolean
	 */
	private function _add( Entry $element ) {
		return parent::add( $element );
	}

	/**
	 * @see AbstractCollection::remove()
	 */
	public function remove( $element ) {
		return $this->_remove( $element );
	}

	/**
	 * Type-safe remove.
	 *
	 * @param Entry $element
	 *
	 * @return boolean
	 */
	private function _remove( Entry $element ) {
		foreach ( $this->elements as $index => $entry ) {
			/* @var $entry Entry */
			if ( $entry->getKey() === $element->getKey() ) {
				unset( $this->elements[ $index ] );
				$this->elements = \array_values( $this->elements );
				return true;
			}
		}

		return false;
	}

	/**
	 * @see AbstractCollection::contains()
	 */
	public function contains( $element ) {
		return $this->_contains( $element );
	}

	/**
	 * Type-safe contains.
	 *
	 * @param Entry $element
	 *
	 * @return boolean
	 */
	private function _contains( Entry $element ) {
		foreach ( $this->elements as $entry ) {
			/* @var $entry Entry */
			if ( $entry->getKey() === $element->getKey() ) {
				return true;
			}
		}

		return false;
	}
}
