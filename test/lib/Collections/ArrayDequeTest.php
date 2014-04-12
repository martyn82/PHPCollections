<?php
namespace Collections;

class ArrayDequeTest extends \TestCase {
	public function testAddFirstElementIncreasesSize() {
		$deque = new ArrayDeque();

		self::assertEquals( 0, $deque->size() );

		$result = $deque->addFirst( 'foo' );
		self::assertTrue( $result );

		self::assertEquals( 1, $deque->size() );
	}

	public function testAddLastElementIncreasesSize() {
		$deque = new ArrayDeque();

		self::assertEquals( 0, $deque->size() );

		$result = $deque->addLast( 'foo' );
		self::assertTrue( $result );

		self::assertEquals( 1, $deque->size() );
	}

	public function testGetDescendingIterator() {
		$deque = new ArrayDeque();
		$deque->add( 'foo' );
		$deque->add( 'bar' );

		$iterator = $deque->getDescendingIterator();
		self::assertInstanceOf( '\Iterator', $iterator );

		$iterator->rewind();
		$first = $iterator->current();
		self::assertEquals( 'bar', $first );

		$iterator->next();
		$second = $iterator->current();
		self::assertEquals( 'foo', $second );
	}

	public function testGetFirstElement() {
		$deque = new ArrayDeque();
		$deque->addFirst( 'foo' );
		self::assertEquals( 'foo', $deque->getFirst() );

		$deque->addFirst( 'bar' );
		self::assertEquals( 'bar', $deque->getFirst() );
	}

	/**
	 * @expectedException \UnderflowException
	 */
	public function testGetFirstElementOnEmptyDeque() {
		$deque = new ArrayDeque();
		$deque->getFirst();
	}

	public function testGetLastElement() {
		$deque = new ArrayDeque();
		$deque->addLast( 'foo' );
		self::assertEquals( 'foo', $deque->getLast() );

		$deque->addLast( 'bar' );
		self::assertEquals( 'bar', $deque->getLast() );
	}

	/**
	 * @expectedException \UnderflowException
	 */
	public function testGetLastElementOnEmptyDeque() {
		$deque = new ArrayDeque();
		$deque->getLast();
	}

	public function testPeekFirstElement() {
		$deque = new ArrayDeque();
		self::assertNull( $deque->peekFirst() );

		$deque->addFirst( 'bar' );
		$deque->addFirst( 'foo' );

		self::assertEquals( 'foo', $deque->peekFirst() );
		self::assertEquals( 2, $deque->size() );
	}

	public function testPeekLastElement() {
		$deque = new ArrayDeque();
		self::assertNull( $deque->peekLast() );

		$deque->addLast( 'foo' );
		$deque->addLast( 'bar' );

		self::assertEquals( 'bar', $deque->peekLast() );
		self::assertEquals( 2, $deque->size() );
	}

	public function testRemoveFirstElement() {
		$deque = new ArrayDeque();
		$deque->addFirst( 'foo' );
		$deque->addFirst( 'bar' );

		$element = $deque->removeFirst();
		self::assertEquals( 'bar', $element );
		self::assertEquals( 1, $deque->size() );
	}

	/**
	 * @expectedException \UnderflowException
	 */
	public function testRemoveFirstElementFromEmptyDeque() {
		$deque = new ArrayDeque();
		$deque->removeFirst();
	}

	public function testRemoveLastElement() {
		$deque = new ArrayDeque();
		$deque->addLast( 'foo' );
		$deque->addLast( 'bar' );

		$element = $deque->removeLast();
		self::assertEquals( 'bar', $element );
		self::assertEquals( 1, $deque->size() );
	}

	/**
	 * @expectedException \UnderflowException
	 */
	public function testRemoveLastElementFromEmptyDeque() {
		$deque = new ArrayDeque();
		$deque->removeLast();
	}

	public function testPollFirstElement() {
		$deque = new ArrayDeque();
		self::assertNull( $deque->pollFirst() );

		$deque->addFirst( 'foo' );
		$deque->addFirst( 'bar' );

		self::assertEquals( 'bar', $deque->pollFirst() );
	}

	public function testPollLastElement() {
		$deque = new ArrayDeque();
		self::assertNull( $deque->pollLast() );

		$deque->addFirst( 'foo' );
		$deque->addLast( 'bar' );

		self::assertEquals( 'bar', $deque->pollLast() );
	}

	public function testEnqueueAddsLast() {
		$deque = new ArrayDeque();
		$deque->enqueue( 'foo' );
		$deque->enqueue( 'bar' );

		self::assertEquals( 'bar', $deque->getLast() );
	}

	public function testDequeueRemovesFirst() {
		$deque = new ArrayDeque();
		$deque->addFirst( 'foo' );
		$deque->addFirst( 'bar' );

		self::assertEquals( 'bar', $deque->dequeue() );
	}

	public function testFrontGetsFirst() {
		$deque = new ArrayDeque();
		$deque->addFirst( 'foo' );
		$deque->addFirst( 'bar' );

		self::assertEquals( 'bar', $deque->front() );
	}
}
