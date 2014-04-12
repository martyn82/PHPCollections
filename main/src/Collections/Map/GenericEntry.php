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
	 * Constructs a GenericEntry instance.
	 *
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function __construct( $key, $value ) {
		$this->key = $key;
		$this->value = $value;
	}

	/**
	 * @see Entry::getKey()
	 */
	public function getKey() {
		return $this->key;
	}

	/**
	 * @see Entry::getValue()
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * @see Entry::setValue()
	 */
	public function setValue( $value ) {
		$previous = $this->value;
		$this->value = $value;
		return $previous;
	}

	/**
	 * @see Entry::__toString()
	 */
	public function __toString() {
		return $this->getKey();
	}
}
