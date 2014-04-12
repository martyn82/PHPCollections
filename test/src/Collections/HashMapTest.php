<?php
namespace Collections;

class HashMapTest extends \TestCase {
	public function testClearLeavesMapEmpty() {
		$map = new HashMap();
		self::assertTrue( $map->isEmpty() );

		$map->put( 'foo', 'bar' );
		self::assertFalse( $map->isEmpty() );

		$map->clear();
		self::assertTrue( $map->isEmpty() );
	}

	public function testContainsKey() {
		$map = new HashMap();
		self::assertFalse( $map->containsKey( 'foo' ) );

		$map->put( 'foo', 'bar' );
		self::assertTrue( $map->containsKey( 'foo' ) );
	}

	public function testContainsValue() {
		$map = new HashMap();
		self::assertFalse( $map->containsValue( 'foo' ) );

		$map->put( '1', 'foo' );
		self::assertTrue( $map->containsValue( 'foo' ) );

		self::assertFalse( $map->containsValue( 'bar' ) );
	}

	public function testEntrySetYieldsEntries() {
		$map = new HashMap();
		$map->put( 'foo', 'bar' );
		$map->put( '12', '34' );
		$map->put( 12, 34 );

		$entries = $map->entrySet();
		$expectedValues = array(
			'bar',
			'34',
			34
		);

		$actualValues = array_map(
			function ( Map\Entry $entry ) {
				return $entry->getValue();
			},
			(array) $entries->toArray()
		);

		self::assertEquals( $expectedValues, $actualValues );

		$expectedKeys = array(
			'foo',
			'12',
			12
		);

		$actualKeys = array_map(
			function ( Map\Entry $entry ) {
				return $entry->getKey();
			},
			(array) $entries->toArray()
		);

		self::assertEquals( $expectedKeys, $actualKeys );
	}

	public function testGetEntry() {
		$map = new HashMap();
		$value = $map->get( 'foo' );
		self::assertNull( $value );

		$map->put( 'foo', 'bar' );
		$value = $map->get( 'foo' );
		self::assertEquals( 'bar', $value );
	}

	public function testKeySetYieldsKeys() {
		$map = new HashMap();
		$map->put( 'foo', 'bar' );
		$map->put( '12', '34' );
		$map->put( 12, 34 );

		$keys = $map->keySet();
		$expected = array(
			'foo',
			'12',
			12
		);

		self::assertEquals( $expected, (array) $keys->toArray() );
	}

	public function testPutEntryIncreasesSize() {
		$map = new HashMap();
		self::assertEquals( 0, $map->size() );

		$map->put( 'foo', 'foo' );
		self::assertEquals( 1, $map->size() );

		$value = $map->get( 'foo' );
		self::assertEquals( 'foo', $value );
	}

	public function testPutAllEntries() {
		$mapA = new HashMap();
		$mapA->put( 'foo', 'bar' );
		$mapA->put( '12', '34' );
		$mapA->put( 12, 34 );

		$mapB = new HashMap();
		$mapB->put( 'foo', 'foo' );
		$mapB->putAll( $mapA );

		self::assertEquals( 3, $mapB->size() );
		self::assertEquals( 'bar', $mapB->get( 'foo' ) );
		self::assertSame( '34', $mapB->get( '12' ) );
		self::assertSame( 34, $mapB->get( 12 ) );
	}

	public function testRemoveEntry() {
		$map = new HashMap();
		$map->put( 12, 34 );
		$map->put( '12', '34' );

		$result = $map->remove( '12' );
		self::assertEquals( '34', $result );

		$result = $map->remove( '34' );
		self::assertNull( $result );

		$value = $map->get( 12 );
		self::assertSame( 34, $value );
	}

	public function testSize() {
		$map = new HashMap();
		self::assertEquals( 0, $map->size() );

		$map->put( 'foo', 'foo' );
		self::assertEquals( 1, $map->size() );
	}

	public function testValuesYieldCollectionOfValues() {
		$map = new HashMap();
		$map->put( 'foo', 'bar' );
		$map->put( 'baz', 'baa' );

		$values = $map->values();
		$expected = array(
			'bar',
			'baa'
		);

		self::assertEquals( $expected, (array) $values->toArray() );
	}
}
