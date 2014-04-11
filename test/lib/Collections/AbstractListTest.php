<?php
namespace Collections;

class AbstractListTest extends \TestCase {
	public function testAddAt() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$result = $list->addAt( 0, 'bar' );

		self::assertTrue( $result );
		self::assertEquals( 2, $list->size() );

		$elements = $list->toArray();
		self::assertEquals( 'bar', $elements[ 0 ] );
		self::assertEquals( 'foo', $elements[ 1 ] );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testAddAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->addAt( 1, 'foo' );
	}

	public function testAddAllAt() {
		$collection = new _Test_AbstractCollection_();
		$collection->add( 'bar' );
		$collection->add( 'baz' );

		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );

		$result = $list->addAllAt( 0, $collection );
		self::assertTrue( $result );

		$elements = $list->toArray();
		self::assertEquals( 'bar', $elements[ 0 ] );
		self::assertEquals( 'baz', $elements[ 1 ] );
		self::assertEquals( 'foo', $elements[ 2 ] );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testAddAllAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->addAllAt( 1, new _Test_AbstractListTest_() );
	}

	public function testGetElementAtIndex() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );

		self::assertEquals( 'foo', $list->get( 0 ) );
		self::assertEquals( 'bar', $list->get( 1 ) );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testGetElementAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->get( -1 );
	}

	public function testIndexOf() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );

		$actual = $list->indexOf( 'bar' );
		self::assertEquals( 1, $actual );
	}

	public function testIndexOfNonExistent() {
		$list = new _Test_AbstractListTest_();
		$index = $list->indexOf( 'foo' );
		self::assertEquals( -1, $index );
	}

	public function testLastIndexOf() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'foo' );
		$list->add( 'foo' );

		$actual = $list->lastIndexOf( 'foo' );
		self::assertEquals( 2, $actual );
	}

	public function testLastIndexOfNonExistent() {
		$list = new _Test_AbstractListTest_();
		$index = $list->lastIndexOf( 'foo' );
		self::assertEquals( -1, $index );
	}

	public function testRemoveAtIndex() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );
		$list->add( 'baz' );

		$removed = $list->removeAt( 1 );
		self::assertEquals( 'bar', $removed );

		$elements = $list->toArray();
		self::assertEquals( 'foo', $elements[ 0 ] );
		self::assertEquals( 'baz', $elements[ 1 ] );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testRemoveAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->removeAt( -21 );
	}

	public function testSetAtIndex() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$old = $list->set( 0, 'bar' );

		self::assertEquals( 'foo', $old );
		self::assertEquals( 'bar', $list->get( 0 ) );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testSetAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->set( 0, 'foo' );
	}

	public function testSubList() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );
		$list->add( 'baz' );

		$subList = $list->subList( 1, 3 );
		self::assertEquals( 2, $subList->size() );

		$expected = array(
			'bar',
			'baz'
		);
		self::assertEquals( $expected, $subList->toArray() );

		$subList = $list->subList( 1, 1 );
		self::assertTrue( $subList->isEmpty() );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testSubListInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->subList( 0, 1 );
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testSubListInvalidRange() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );
		$list->subList( 1, 0 );
	}

	public function testGetIteratorAtIndex() {
		$list = new _Test_AbstractListTest_();
		$list->add( 'foo' );
		$list->add( 'bar' );
		$list->add( 'baz' );

		$iterator = $list->getIteratorAt( 1 );
		self::assertEquals( 'bar', $iterator->current() );

		$iterator->next();
		self::assertEquals( 'baz', $iterator->current() );
	}

	/**
	 * @expectedException \OutOfBoundsException
	 */
	public function testGetIteratorAtInvalidIndex() {
		$list = new _Test_AbstractListTest_();
		$list->getIteratorAt( 100 );
	}
}

class _Test_AbstractListTest_ extends AbstractList {}
