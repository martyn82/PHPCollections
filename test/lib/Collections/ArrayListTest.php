<?php
use Collections\ArrayList;

class ArrayListTest extends PHPUnit_Framework_TestCase {
    private $list;
    
    public function setUp() {
        $this->list = new ArrayList( new String( 'String' ) );
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testAdd_Type() {
        $this->list->add( 1 );
    }
    
    public function testAdd() {
        $this->list->add( new String( '' ) );
        self::assertEquals( 1, $this->list->size() );
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddAll_Type() {
        $list = new ArrayList( new String( 'Integer' ) );
        $list->add( new Integer( 1 ) );
        
        $this->list->addAll( $list );
    }
    
    public function testAddAll() {
        $list = new ArrayList( new String( 'String' ) );
        $list->add( new String( 'foo' ) );
        
        $this->list->addAll( $list );
        self::assertEquals( $list->size(), $this->list->size() );
    }
    
    public function testSize() {
        self::assertEquals( 0, $this->list->size() );
        $this->list->add( new String( 'foo' ) );
        self::assertEquals( 1, $this->list->size() );
    }
    
    public function testClear() {
        $this->list->add( new String( 'foo' ) );
        self::assertEquals( 1, $this->list->size() );
        
        $this->list->clear();
        self::assertEquals( 0, $this->list->size() );
    }
    
    public function testContains() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        self::assertFalse( $this->list->contains( new String( 'baz' ) ) );
        self::assertTrue( $this->list->contains( new String( 'foo' ) ) );
    }
    
    public function testContainsAll() {
        $list = new ArrayList( new String( 'String' ) );
        $list->add( new String( 'foo' ) );
        $list->add( new String( 'bar' ) );
        
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        $this->list->add( new String( 'baz' ) );
        
        self::assertTrue( $this->list->containsAll( $list ) );
        
        $otherList = new ArrayList( new String( 'String' ) );
        $otherList->add( new String( 'bax' ) );
        
        self::assertFalse( $this->list->containsAll( $otherList ) );
    }
    
    public function testIsEmpty() {
        self::assertTrue( $this->list->isEmpty() );
        $this->list->add( new String( 'foo' ) );
        self::assertFalse( $this->list->isEmpty() );
    }
    
    public function testIterator() {
        self::assertTrue( $this->list->iterator() instanceof \Iterator );
    }
    
    public function testRemove() {
        $item = new String( 'foo' );
        $this->list->add( $item );
        $this->list->remove( $item );
        self::assertEquals( 0, $this->list->size() );
    }
    
    public function testRemoveAll() {
        $list = new ArrayList( new String( 'String' ) );
        $list->add( new String( 'foo' ) );
        
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        $this->list->removeAll( $list );
        self::assertEquals( 1, $this->list->size() );
    }
    
    public function testRetainAll() {
        $list = new ArrayList( new String( 'String' ) );
        $list->add( new String( 'foo' ) );
        
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        $this->list->retainAll( $list );
        self::assertEquals( 1, $this->list->size() );
    }
    
    public function testToArray() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        $array = array( new String( 'foo' ), new String( 'bar' ) );
        self::assertEquals( $array, $this->list->toArray() );
    }
    
    public function testGet() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        self::assertEquals( new String( 'foo' ), $this->list->get( new Integer( 0 ) ) );
        self::assertEquals( new String( 'bar' ), $this->list->get( new Integer( 1 ) ) );
    }
    
    public function testIndexOf() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        self::assertEquals( 1, $this->list->indexOf( new String( 'bar' ) ) );
    }
    
    public function testLastIndexOf() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        $this->list->add( new String( 'baz' ) );
        
        self::assertEquals( 2, $this->list->lastIndexOf( new String( 'foo' ) ) );
    }
    
    public function testListIterator() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        $this->list->add( new String( 'baz' ) );
        
        $iterator = $this->list->listIterator( new Integer( 2 ) );
        self::assertTrue( $iterator instanceof \Iterator );
        self::assertEquals( 3, $iterator->count() );
    }
    
    public function testSet() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        
        $this->list->set( new Integer( 1 ), new String( 'baz' ) );
        self::assertEquals( new String( 'baz' ), $this->list->get( new Integer( 1 ) ) );
    }
    
    public function testSubList() {
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'foo' ) );
        $this->list->add( new String( 'bar' ) );
        $this->list->add( new String( 'baz' ) );
        
        $list = $this->list->subList( new Integer( 2 ), new Integer( 3 ) );
        self::assertTrue( $list instanceof ArrayList );
        self::assertEquals( 1, $list->size() );
    }
}
