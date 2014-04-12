<?php
namespace Collections;

class AbstractCollectionTest extends \TestCase {
	/**
	 * @dataProvider elementProvider
	 *
	 * @param mixed $element
	 */
	public function testAddElementChangesCollection( $element ) {
		$collection = new _Test_AbstractCollection_();
		$result = $collection->add( $element );

		self::assertTrue( $result );
		self::assertEquals( 1, $collection->size() );

		$elements = $collection->toArray();
		self::assertEquals( $element, $elements[ 0 ] );
	}

	public function elementProvider() {
		return array(
			array( 'foo' ),
			array( 6781 ),
			array( true ),
			array( false ),
			array( null ),
			array( .43 ),
			array( new \stdClass() ),
			array( array( 'foo' => 121 ) )
		);
	}

	public function testAddAllElementsChangesCollection() {
		$collectionA = new _Test_AbstractCollection_();
		$collectionA->add( 'foo' );
		$collectionA->add( 'bar' );
		$collectionA->add( 'baz' );

		$collectionB = new _Test_AbstractCollection_();
		$result = $collectionB->addAll( $collectionA );

		self::assertTrue( $result );
		self::assertEquals( 3, $collectionB->size() );
	}

	public function testClearMakesCollectionEmpty() {
		$collection = new _Test_AbstractCollection_();
		$collection->add( 'foo' );
		$collection->clear();

		self::assertEquals( 0, $collection->size() );
	}

	public function testContainsElement() {
		$element = 'foo';

		$collection = new _Test_AbstractCollection_();
		$collection->add( $element );

		self::assertTrue( $collection->contains( $element ) );
	}

	public function testNotContainsElement() {
		$element = 'foo';
		$collection = new _Test_AbstractCollection_();
		self::assertFalse( $collection->contains( $element ) );
	}

	public function testContainsAllElements() {
		$collectionA = new _Test_AbstractCollection_();
		$collectionA->add( 'foo' );
		$collectionA->add( 'bar' );
		$collectionA->add( 'foo' );

		$collectionB = new _Test_AbstractCollection_();
		$collectionB->add( 'bar' );
		$collectionB->add( 'baz' );
		$collectionB->add( 'foo' );

		self::assertTrue( $collectionB->containsAll( $collectionA ) );
		self::assertFalse( $collectionA->containsAll( $collectionB ) );
	}

	public function testIsEmpty() {
		$collection = new _Test_AbstractCollection_();
		self::assertTrue( $collection->isEmpty() );

		$collection->add( 'foo' );
		self::assertFalse( $collection->isEmpty() );
	}

	public function testGetIterator() {
		$collection = new _Test_AbstractCollection_();
		$iterator = $collection->getIterator();
		self::assertInstanceOf( '\Iterator', $iterator );
	}

	public function testRemoveElement() {
		$collection = new _Test_AbstractCollection_();
		$result = $collection->remove( 'foo' );

		self::assertFalse( $result );

		$collection->add( 'foo' );
		$result = $collection->remove( 'foo' );

		self::assertTrue( $result );
		self::assertEquals( 0, $collection->size() );
	}

	public function testRemoveAllElements() {
		$collectionA = new _Test_AbstractCollection_();
		$collectionA->add( 'foo' );
		$collectionA->add( 'bar' );

		$collectionB = new _Test_AbstractCollection_();
		$collectionB->add( 'foo' );
		$collectionB->add( 'foo' );
		$collectionB->add( 'baz' );

		self::assertTrue( $collectionA->removeAll( $collectionB ) );
		self::assertEquals( 1, $collectionA->size() );

		self::assertFalse( $collectionB->removeAll( $collectionA ) );
	}

	public function testRetainAllElements() {
		$collectionA = new _Test_AbstractCollection_();
		$collectionA->add( 'foo' );
		$collectionA->add( 'bar' );

		$collectionB = new _Test_AbstractCollection_();
		$collectionB->add( 'foo' );

		self::assertTrue( $collectionA->retainAll( $collectionB ) );
		self::assertFalse( $collectionA->retainAll( $collectionB ) );

		$elements = $collectionA->toArray();
		self::assertEquals( 'foo', $elements[ 0 ] );
	}

	public function testSize() {
		$collection = new _Test_AbstractCollection_();
		self::assertEquals( 0, $collection->size() );

		$collection->add( 'foo' );
		self::assertEquals( 1, $collection->size() );
	}

	public function testConvertToArray() {
		$collection = new _Test_AbstractCollection_();
		$collection->add( 'foo' );
		$collection->add( 'bar' );
		$collection->add( 'baz' );

		$collection->remove( 'bar' ); // should not adjust the index positions

		$actual = $collection->toArray();
		$expected = array(
			0 => 'foo',
			1 => 'baz'
		);

		self::assertEquals( $expected, $actual );
	}
}

class _Test_AbstractCollection_ extends AbstractCollection {}
