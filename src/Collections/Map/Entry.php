<?php
namespace Collections\Map;

interface Entry {
	/**
	 * Returns the key corresponding to this entry.
	 *
	 * @return mixed
	 */
	function getKey();

	/**
	 * Returns the corresponding value to this entry.
	 *
	 * @return mixed
	*/
	function getValue();

	/**
	 * Replaces the value corresponding to this entry with the specified value.
	 *
	 * @param mixed $value
	 *
	 * @return mixed The old value corresponding to this entry.
	*/
	function setValue( $value );
}
