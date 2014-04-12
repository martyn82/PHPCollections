<?php
namespace Collections\Map;

class EntrySetTest extends \TestCase {
	private $entryClassName = '\Collections\Map\Entry';

	public function testAddEntry() {
		$entrySet = new EntrySet();
		self::assertEquals( 0, $entrySet->size() );

		$entry = $this->getMock( $this->entryClassName );
		$entrySet->add( $entry );
		self::assertEquals( 1, $entrySet->size() );
	}

	public function testRemoveEntry() {
		$entrySet = new EntrySet();

		$entry = $this->getMock( $this->entryClassName );

		$entrySet->add( $entry );
		self::assertEquals( 1, $entrySet->size() );

		$entrySet->remove( $entry );
		self::assertEquals( 0, $entrySet->size() );

		$result = $entrySet->remove( $entry );
		self::assertFalse( $result );
	}

	public function testContainsEntry() {
		$entrySet = new EntrySet();
		$entry = $this->getMock( $this->entryClassName );

		self::assertFalse( $entrySet->contains( $entry ) );

		$entrySet->add( $entry );
		self::assertTrue( $entrySet->contains( $entry ) );
	}

	public function testContainsAllEntries() {
		$entrySetA = new EntrySet();
		$entry = $this->getMock( $this->entryClassName );

		$entrySetB = new EntrySet();
		$entrySetB->add( $entry );

		self::assertFalse( $entrySetA->containsAll( $entrySetB ) );

		$entrySetA->addAll( $entrySetB );
		self::assertTrue( $entrySetA->containsAll( $entrySetB ) );
	}
}
