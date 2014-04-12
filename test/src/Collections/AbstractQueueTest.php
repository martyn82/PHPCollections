<?php
namespace Collections;

class AbstractQueueTest extends \TestCase {
	public function testEnqueueElement() {
		$queue = new _Test_AbstractQueueTest_();
		$result = $queue->enqueue( 'foo' );

		self::assertTrue( $result );
		self::assertEquals( 1, $queue->size() );
	}

	public function testFrontRetrievesHead() {
		$queue = new _Test_AbstractQueueTest_();
		$queue->enqueue( 'foo' );
		self::assertEquals( 'foo', $queue->front() );
	}

	/**
	 * @expectedException \UnderflowException
	 */
	public function testFrontOnEmptyQueue() {
		$queue = new _Test_AbstractQueueTest_();
		$queue->front();
	}

	public function testDequeueElement() {
		$queue = new _Test_AbstractQueueTest_();
		$queue->enqueue( 'foo' );
		$element = $queue->dequeue();

		self::assertEquals( 'foo', $element );
		self::assertTrue( $queue->isEmpty() );
	}

	public function testDequeueEmptyQueue() {
		$queue = new _Test_AbstractQueueTest_();
		$element = $queue->dequeue();

		self::assertNull( $element );
	}
}

class _Test_AbstractQueueTest_ extends AbstractQueue {}
