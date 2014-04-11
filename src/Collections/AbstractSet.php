<?php
namespace Collections;

abstract class AbstractSet extends AbstractCollection implements Set {
	/**
	 * @see Set::add()
	 */
	public function add( $element ) {
		if ( $this->contains( $element ) ) {
			return false;
		}

		return parent::add( $element );
	}
}
