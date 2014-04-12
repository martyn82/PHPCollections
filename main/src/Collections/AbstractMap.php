<?php
namespace Collections;

abstract class AbstractMap implements Map {
	/**
	 * @var Map\EntrySet
	 */
	protected $entries;

	/**
	 * Constructs a new Map instance.
	 */
	public function __construct() {
		$this->entries = new Map\EntrySet();
	}

	/**
	 * @see Map::clear()
	 */
	public function clear() {
		$this->entries->clear();
	}

	/**
	 * @see Map::containsKey()
	 */
	public function containsKey( $key ) {
		foreach ( $this->entries->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @see Map::containsValue()
	 */
	public function containsValue( $value ) {
		foreach ( $this->entries->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getValue() === $value ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @see Map::entrySet()
	 */
	public function entrySet() {
		return $this->entries;
	}

	/**
	 * @see Map::get()
	 */
	public function get( $key ) {
		foreach ( $this->entries->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				return $entry->getValue();
			}
		}

		return null;
	}

	/**
	 * @see Map::isEmpty()
	 */
	public function isEmpty() {
		return $this->entries->isEmpty();
	}

	/**
	 * @see Map::keySet()
	 */
	public function keySet() {
		$set = $this->createSet();

		foreach ( $this->entries->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			$set->add( $entry->getKey() );
		}

		return $set;
	}

	/**
	 * @see Map::put()
	 */
	public function put( $key, $value ) {
		$result = null;

		if ( $this->containsKey( $key ) ) {
			$result = $this->get( $key );
		}

		$entry = $this->createMapEntry( $key, $value );
		$this->entries->add( $entry );

		return $result;
	}

	/**
	 * @see Map::putAll()
	 */
	public function putAll( Map $map ) {
		foreach ( $map->entrySet()->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			$this->put( $entry->getKey(), $entry->getValue() );
		}
	}

	/**
	 * @see Map::remove()
	 */
	public function remove( $key ) {
		$iterator = $this->entries->getIterator();

		foreach ( $iterator as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				$value = $entry->getValue();
				$result = $this->entries->remove( $entry );
				return $value;
			}
		}

		return null;
	}

	/**
	 * @see Map::size()
	 */
	public function size() {
		return $this->entries->size();
	}

	/**
	 * @see Map::values()
	 */
	public function values() {
		$collection = $this->createCollection();

		foreach ( $this->entries->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			$collection->add( $entry->getValue() );
		}

		return $collection;
	}

	/**
	 * Creates and returns a new <code>Map\Entry</code> instance.
	 *
	 * @param mixed $key
	 * @param mixed $value
	 *
	 * @return Map\GenericEntry
	 */
	protected function createMapEntry( $key, $value ) {
		return new Map\GenericEntry( $key, $value );
	}

	/**
	 * Creates and returns a new <code>Set</code> instance.
	 *
	 * @return Set
	 */
	protected function createSet() {
		return new GenericSet();
	}

	/**
	 * Creates and returns a new <code>Collection</code> instance.
	 *
	 * @return Collection
	 */
	protected function createCollection() {
		return new GenericCollection();
	}
}
