<?php
namespace Collections;

class AbstractMapTest extends \TestCase {
	public function testClearMap() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'key', 'value' );
		$map->clear();
		self::assertTrue( $map->isEmpty() );
	}

	public function testContainsKey() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'key', 'value' );

		self::assertTrue( $map->containsKey( 'key' ) );
		self::assertFalse( $map->containsKey( 'bar' ) );
	}

	public function testContainsValue() {
		$map = new _Test_AbstractMapTest_();
		self::assertFalse( $map->containsValue( 'foo' ) );

		$map->put( 0, 'foo' );
		self::assertTrue( $map->containsValue( 'foo' ) );
	}

	public function testEntrySet() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'fooKey', 'fooValue' );
		$map->put( 312, '321_value' );
		$map->put( array(), array() );

		$entries = $map->entrySet();
		self::assertInstanceOf( '\Collections\Set', $entries );
		self::assertInstanceOf( '\Collections\Map\EntrySet', $entries );

		self::assertEquals( $map->size(), $entries->size() );
	}

	public function testGetEntry() {
		$map = new _Test_AbstractMapTest_();

		$value = $map->get( 'foo' );
		self::assertNull( $value );

		$map->put( 'foo', 'bar' );
		$value = $map->get( 'foo' );
		self::assertEquals( 'bar', $value );
	}

	public function testIsEmpty() {
		$map = new _Test_AbstractMapTest_();
		self::assertTrue( $map->isEmpty() );

		$map->put( 'foo', 'bar' );
		self::assertFalse( $map->isEmpty() );
	}

	public function testKeySet() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'foo', 'bar' );
		$map->put( 'bar', 'baz' );
		$map->put( 'baz', 'baa' );

		$keys = $map->keySet();
		self::assertInstanceOf( '\Collections\Set', $keys );

		self::assertEquals( 3, $keys->size() );

		$expected = array(
			'foo',
			'bar',
			'baz'
		);

		self::assertEquals( $expected, (array) $keys->toArray() );
	}

	/**
	 * @dataProvider entryProvider
	 *
	 * @param mixed $key
	 * @param mixed $value
	 */
	public function testPutEntry( $key, $value ) {
		$map = new _Test_AbstractMapTest_();
		$result = $map->put( $key, $value );

		self::assertNull( $result );
	}

	public function entryProvider() {
		return array(
			array( 'fooKey', 'fooValue' ),
			array( 'barKey', 131 ),
			array( 'bazKey', .4 ),
			array( 431, 'barValue' ),
			array( true, false ),
			array( false, true ),
			array( null, null ),
			array( array(), array() ),
			array( new \stdClass(), 'objectKeyValue' ),
		);
	}

	public function testSubsequentPut() {
		$map = new _Test_AbstractMapTest_();

		$result = $map->put( 'foo', 'bar' );
		self::assertNull( $result );

		$result = $map->put( 'foo', 'baz' );
		self::assertEquals( 'bar', $result );

		$result = $map->put( 0, 'foo' );
		self::assertNull( $result );

		$result = $map->put( null, 'bar' );
		self::assertNull( $result );

		$result = $map->put( 123, 123 );
		self::assertNull( $result );

		$result = $map->put( '123', '123' );
		self::assertNull( $result );
	}

	public function testPutAllEntries() {
		$mapA = new _Test_AbstractMapTest_();
		$mapA->put( 'foo', 'bar' );
		$mapA->put( 'bar', 'baz' );

		$mapB = new _Test_AbstractMapTest_();
		$mapB->put( 'baz', 'baa' );
		$mapB->putAll( $mapA );

		self::assertEquals( $mapA->size() + 1, $mapB->size() );

		self::assertTrue( $mapB->containsKey( 'foo' ) );
		self::assertTrue( $mapB->containsKey( 'bar' ) );
		self::assertTrue( $mapB->containsKey( 'baz' ) );
	}

	public function testRemoveEntry() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'foo', 'bar' );
		$map->put( 'bar', 'baz' );

		$result = $map->remove( 'foo' );
		self::assertEquals( 'bar', $result );

		$result = $map->remove( 'baz' );
		self::assertNull( $result );
	}

	public function testSize() {
		$map = new _Test_AbstractMapTest_();
		self::assertEquals( 0, $map->size() );

		$map->put( 'foo', 'foo' );
		self::assertEquals( 1, $map->size() );

		$result = $map->remove( 'foo' );
		self::assertEquals( 'foo', $result );
		self::assertEquals( 0, $map->size() );
	}

	public function testValues() {
		$map = new _Test_AbstractMapTest_();
		$map->put( 'fooKey', 'fooValue' );
		$map->put( 'barKey', 'barValue' );

		$values = $map->values();
		self::assertInstanceOf( '\Collections\Collection', $values );

		$expected = array(
			'fooValue',
			'barValue'
		);

		self::assertEquals( $expected, (array) $values->toArray() );
	}
}

class _Test_AbstractMapTest_ extends AbstractMap {}
