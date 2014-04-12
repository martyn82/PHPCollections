<?php
namespace Collections;

class HashMap extends AbstractMap implements Map {
	/**
	 * @var array
	 */
	private $buckets;

	/**
	 * Constructs a new HashMap instance.
	 */
	public function __construct() {
		$this->clear();
	}

	/**
	 * @see AbstractMap::clear()
	 */
	public function clear() {
		$this->buckets = array();
	}

	/**
	 * @see AbstractMap::containsKey()
	 */
	public function containsKey( $key ) {
		$hash = $this->hashKey( $key );
		$bucket = $this->getBucketByHash( $hash );

		foreach ( $bucket->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @see AbstractMap::containsValue()
	 */
	public function containsValue( $value ) {
		foreach ( $this->buckets as $bucket ) {
			/* @var $bucket Map\EntrySet */
			foreach ( $bucket->getIterator() as $entry ) {
				/* @var $entry Map\Entry */
				if ( $entry->getValue() === $value ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * @see AbstractMap::entrySet()
	 */
	public function entrySet() {
		$result = new Map\EntrySet();

		foreach ( $this->buckets as $bucket ) {
			/* @var $bucket Map\EntrySet */
			$result->addAll( $bucket );
		}

		return $result;
	}

	/**
	 * @see AbstractMap::get()
	 */
	public function get( $key ) {
		$hash = $this->hashKey( $key );
		$bucket = $this->getBucketByHash( $hash );

		foreach ( $bucket->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				return $entry->getValue();
			}
		}

		return null;
	}

	/**
	 * @see AbstractMap::isEmpty()
	 */
	public function isEmpty() {
		return $this->size() == 0;
	}

	/**
	 * @see AbstractMap::keySet()
	 */
	public function keySet() {
		$result = $this->createSet();

		foreach ( $this->buckets as $bucket ) {
			/* @var $bucket Map\EntrySet */
			foreach ( $bucket->getIterator() as $entry ) {
				/* @var $entry Map\Entry */
				$result->add( $entry->getKey() );
			}
		}

		return $result;
	}

	/**
	 * @see AbstractMap::put()
	 */
	public function put( $key, $value ) {
		$hash = $this->hashKey( $key );
		$bucket = $this->getBucketByHash( $hash );
		$result = null;

		foreach ( $bucket->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				$result = $entry->getValue();
				break;
			}
		}

		$entry = $this->createMapEntry( $key, $value );
		$bucket->remove( $entry );
		$bucket->add( $entry );

		return $result;
	}

	/**
	 * @see AbstractMap::putAll()
	 */
	public function putAll( Map $map ) {
		foreach ( $map->entrySet()->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			$this->put( $entry->getKey(), $entry->getValue() );
		}
	}

	/**
	 * @see AbstractMap::remove()
	 */
	public function remove( $key ) {
		$hash = $this->hashKey( $key );
		$bucket = $this->getBucketByHash( $hash );

		foreach ( $bucket->getIterator() as $entry ) {
			/* @var $entry Map\Entry */
			if ( $entry->getKey() === $key ) {
				$result = $entry->getValue();
				$bucket->remove( $entry );
				return $result;
			}
		}

		return null;
	}

	/**
	 * @see AbstractMap::size()
	 */
	public function size() {
		$result = 0;

		foreach ( $this->buckets as $bucket ) {
			/* @var $bucket Map\EntrySet */
			$result += $bucket->size();
		}

		return $result;
	}

	/**
	 * @see AbstractMap::values()
	 */
	public function values() {
		$result = $this->createCollection();

		foreach ( $this->buckets as $bucket ) {
			/* @var $bucket Map\EntrySet */
			foreach ( $bucket->getIterator() as $entry ) {
				/* @var $entry Map\Entry */
				$result->add( $entry->getValue() );
			}
		}

		return $result;
	}

	/**
	 * Computes the hash for the specified key.
	 *
	 * @param mixed $key
	 *
	 * @return integer
	 */
	protected function hashKey( $key ) {
		return \crc32( $key );
	}

	/**
	 * Retrieves or creates a bucket by hash.
	 *
	 * @param integer $hash
	 *
	 * @return Set
	 */
	private function getBucketByHash( $hash ) {
		if ( !isset( $this->buckets[ $hash ] ) ) {
			$this->buckets[ $hash ] = new Map\EntrySet();
		}

		return $this->buckets[ $hash ];
	}
}
