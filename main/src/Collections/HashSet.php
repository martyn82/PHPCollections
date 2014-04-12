<?php
namespace Collections;

class HashSet extends AbstractSet implements Set {
	/**
	 * @var Map
	 */
	private $map;

	/**
	 * Constructs a new HashSet instance.
	 */
	public function __construct() {
		$this->map = new HashMap();
	}

	/**
	 * @see AbstractSet::add()
	 */
	public function add( $element ) {
		if ( $this->contains( $element ) ) {
			return false;
		}

		$key = $this->hashValue( $element );
		$this->map->put( $key, $element );

		return true;
	}

	/**
	 * @see AbstractCollection::remove()
	 */
	public function remove( $element ) {
		if ( !$this->contains( $element ) ) {
			return false;
		}

		$key = $this->hashValue( $element );
		return $this->map->remove( $key ) !== null;
	}

	/**
	 * @see AbstractCollection::contains()
	 */
	public function contains( $element ) {
		$key = $this->hashValue( $element );
		return $this->map->containsKey( $key );
	}

	/**
	 * @see AbstractCollection::containsAll()
	 */
	public function containsAll( Collection $elements ) {
		$result = false;

		foreach ( $elements->toArray() as $element ) {
			$result = $this->contains( $element ) || $result;
		}

		return $result;
	}

	/**
	 * @see AbstractCollection::clear()
	 */
	public function clear() {
		$this->map->clear();
	}

	/**
	 * @see AbstractCollection::getIterator()
	 */
	public function getIterator() {
		return new \ArrayIterator( (array) $this->toArray() );
	}

	/**
	 * @see AbstractCollection::retainAll()
	 */
	public function retainAll( Collection $elements ) {
		$newElements = \array_values(
			\array_intersect(
				(array) $this->map->values()->toArray(),
				(array) $elements->toArray()
			)
		);
		$result = $newElements != $this->elements;
		$this->elements = $newElements;
		return $result;
	}

	/**
	 * @see AbstractCollection::size()
	 */
	public function size() {
		return $this->map->size();
	}

	/**
	 * @see AbstractCollection::toArray()
	 */
	public function toArray() {
		return $this->map->values()->toArray();
	}

	/**
	 * Computes a hash value from specified element.
	 *
	 * @param mixed $element
	 *
	 * @return integer
	 */
	protected function hashValue( $element ) {
		return \is_object( $element )
		? \spl_object_hash( $element )
		: \crc32( $element );
	}
}
