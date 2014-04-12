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
}
