<?php
namespace Collections\Map;

class GenericEntry implements Entry {
	/**
	 * @var mixed
	 */
	private $key;

	/**
	 * @var mixed
	 */
	private $value;

	/**
	 * Constructs a MapEntry instance.
	 *
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function __construct( $key, $value ) {
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * @see MapEntry::getKey()
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @see MapEntry::getValue()
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @see MapEntry::setValue()
	 */
	public function setValue( $value ) {
		$previous = $this->value;
		$this->value = $value;
		return $previous;
	}
}
