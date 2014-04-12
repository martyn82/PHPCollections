<?php
namespace Collections;

interface Map {
	/**
	 * Removes all the mappings from this map. The map will be empty after this call returns.
	 */
	function clear();

	/**
	 * Returns <code>true</code> if this map contains a mapping for the specified key.
	 *
	 * @param mixed $key
	 *
	 * @return <code>true</code> if this map contains a mapping for the specified key.
	*/
	function containsKey( $key );

	/**
	 * Returns <code>true</code> if this map maps one or more keys to the specified value.
	 *
	 * @param mixed $value
	 *
	 * @return boolean <code>true</code> if this map maps one or more keys to the specified value.
	*/
	function containsValue( $value );

	/**
	 * Returns a <code>Set</code> view of the mappings contained in this map.
	 *
	 * @return MapEntrySet
	*/
	function entrySet();

	/**
	 * Returns the value to which the specified key is mapped, or <code>null</code> if this map contains no mapping for
	 * the key.
	 *
	 * @param mixed $key
	 *
	 * @return mixed
	*/
	function get( $key );

	/**
	 * Returns <code>true</code> if this map contains no key-value mappings.
	 *
	 * @return boolean
	*/
	function isEmpty();

	/**
	 * Returns a <code>Set</code> view of the keys contained in this map.
	 *
	 * @return Set
	*/
	function keySet();

	/**
	 * Associates the specified value with the specified key in this map. If the map previously contained a mapping for
	 * the key, the old value is replaced by the specified value. The previous value will be returned.
	 *
	 * @param mixed $key
	 * @param mixed $value
	 *
	 * @return mixed The previous value associated by the specified key, or <code>null</code> if there was no mapping
	 * for the key.
	*/
	function put( $key, $value );

	/**
	 * Copies all of the mappings from the specified map to this map. The effect of this call is equivalent to that of
	 * calling put on this map once for each mapping from key to value in the specified map.
	 *
	 * @param Map $map
	*/
	function putAll( Map $map );

	/**
	 * Removes the mapping for a key from this map if it is present.
	 *
	 * @param mixed $key
	 *
	 * @return mixed The previous value associated with the specified key, or <code>null</code> if there was no mapping
	 * for the key.
	*/
	function remove( $key );

	/**
	 * Returns the number of key-value mappings in this map.
	 *
	 * @return integer
	*/
	function size();

	/**
	 * Returns a Collection view of the values contained in this map.
	 *
	 * @return Collection
	*/
	function values();
}
