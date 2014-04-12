<?php
namespace Collections;

class HashSetTest extends \TestCase {
	public function testAddElementOnce() {
		$set = new HashSet();
		self::assertEquals( 0, $set->size() );

		$obj = new \stdClass();

		$result = $set->add( $obj );
		self::assertTrue( $result );
		self::assertEquals( 1, $set->size() );

		$result = $set->add( $obj );
		self::assertFalse( $result );
		self::assertEquals( 1, $set->size() );
	}

	public function testRemoveElement() {
		$set = new HashSet();

		$value = new \stdClass();
		$set->add( $value );

		$result = $set->remove( new \stdClass() );
		self::assertFalse( $result );

		$result = $set->remove( $value );
		self::assertTrue( $result );
	}

	public function testContainsElement() {
		$set = new HashSet();
		$value = new \stdClass();
		$set->add( $value );

		self::assertTrue( $set->contains( $value ) );
		self::assertFalse( $set->contains( new \stdClass() ) );
	}

	public function testContainsAll() {
		$setA = new HashSet();
		$setA->add( new \stdClass() );

		self::assertTrue( $setA->containsAll( $setA ) );

		$setB = new HashSet();
		$setB->add( new \stdClass() );

		self::assertFalse( $setA->containsAll( $setB ) );
	}

	public function testClear() {
		$set = new HashSet();
		$set->add( 'foo' );
		self::assertFalse( $set->isEmpty() );

		$set->clear();
		self::assertTrue( $set->isEmpty() );
	}

	public function testGetIterator() {
		$set = new HashSet();
		$set->add( 'foo' );
		$set->add( 'bar' );

		$iterator = $set->getIterator();

		$iterator->rewind();
		self::assertEquals( 'foo', $iterator->current() );

		$iterator->next();
		self::assertEquals( 'bar', $iterator->current() );
	}

	public function testRetainAllElements() {
		$setA = new HashSet();
		$setA->add( 'foo' );
		$setA->add( 'bar' );

		$setB = new HashSet();
		$setB->add( 'foo' );

		self::assertTrue( $setA->retainAll( $setB ) );
		self::assertFalse( $setA->retainAll( $setB ) );

		$elements = $setA->toArray();
		self::assertEquals( 'foo', $elements[ 0 ] );
	}
}
