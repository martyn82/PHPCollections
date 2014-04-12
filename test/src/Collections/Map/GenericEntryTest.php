<?php
namespace Collections\Map;

class GenericEntryTest extends \TestCase {
	public function testGetKeyRetrievesKey() {
		$entry = new GenericEntry( 'foo', 'bar' );
		self::assertEquals( 'foo', $entry->getKey() );
	}

	public function testGetValueRetrievesValue() {
		$entry = new GenericEntry( 'foo', 'bar' );
		self::assertEquals( 'bar', $entry->getValue() );
	}

	public function testSetValueChangesValue() {
		$entry = new GenericEntry( 'foo', 'bar' );
		self::assertEquals( 'bar', $entry->getValue() );

		$newValue = 'baz';
		$entry->setValue( $newValue );
		self::assertEquals( $newValue, $entry->getValue() );
	}

	public function testToStringConversionYieldsKey() {
		$entry = new GenericEntry( 'foo', 'bar' );
		self::assertEquals( 'foo', $entry->__toString() );
	}
}
