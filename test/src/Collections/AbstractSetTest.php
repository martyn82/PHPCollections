<?php
namespace Collections;

class AbstractSetTest extends \TestCase {
	public function testAddIsIdempotent() {
		$set = new _Test_AbstractSetTest_();
		$result = $set->add( 'foo' );
		self::assertTrue( $result );

		$result = $set->add( 'foo' );
		self::assertFalse( $result );

		self::assertEquals( 1, $set->size() );
	}

	public function testAddAllAddsUnique() {
		$setA = new _Test_AbstractSetTest_();
		$setA->add( 'foo' );

		$collectionB = new _Test_AbstractCollection_();
		$collectionB->add( 'foo' );

		self::assertFalse( $setA->addAll( $collectionB ) );
	}

	public function testRemoveAllYieldsAsymmetricDifference() {
		$setA = new _Test_AbstractSetTest_();
		$setA->add( 'foo' );
		$setA->add( 'bar' );

		$setB = new _Test_AbstractSetTest_();
		$setB->add( 'foo' );
		$setB->add( 'baz' );

		$result = $setA->removeAll( $setB );

		self::assertTrue( $result );
		self::assertTrue( $setA->contains( 'bar' ) );
		self::assertFalse( $setA->contains( 'foo' ) );
	}

	public function testAddAllYieldsUnion() {
		$setA = new _Test_AbstractSetTest_();
		$setA->add( 'foo' );
		$setA->add( 'bar' );

		$setB = new _Test_AbstractSetTest_();
		$setB->add( 'foo' );
		$setB->add( 'baz' );

		$setA->addAll( $setB );

		self::assertTrue( $setA->containsAll( $setB ) );
	}
}

class _Test_AbstractSetTest_ extends AbstractSet {}
