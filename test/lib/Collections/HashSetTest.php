<?php
use Collections\HashSet;

class HashSetTest extends PHPUnit_Framework_TestCase {
    private $set;
    
    public function setUp() {
        $this->set = new HashSet( new String( 'String' ) );
    }
    
    public function testAdd() {
        $this->set->add( new String( '' ) );
        self::assertEquals( 1, $this->set->size() );
    }
    
    public function testAdd_Unique() {
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
        $this->set->add( new String( 'foo' ) );
        
        self::assertEquals( 2, $this->set->size() );
    }
    
    /**
    * @expectedException InvalidArgumentException
    */
    public function testAdd_Type() {
        $this->set->add( 1 );
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testAddAll_Type() {
        $set = new HashSet( new String( 'Integer' ) );
        $set->add( new Integer( 1 ) );
    
        $this->set->addAll( $set );
    }
    
    public function testAddAll() {
        $set = new HashSet( new String( 'String' ) );
        $set->add( new String( 'foo' ) );
    
        $this->set->addAll( $set );
        self::assertEquals( $set->size(), $this->set->size() );
    }
    
    public function testSize() {
        self::assertEquals( 0, $this->set->size() );
        $this->set->add( new String( 'foo' ) );
        self::assertEquals( 1, $this->set->size() );
    }
    
    public function testClear() {
        $this->set->add( new String( 'foo' ) );
        self::assertEquals( 1, $this->set->size() );
    
        $this->set->clear();
        self::assertEquals( 0, $this->set->size() );
    }
    
    public function testContains() {
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
    
        self::assertFalse( $this->set->contains( new String( 'baz' ) ) );
        self::assertTrue( $this->set->contains( new String( 'foo' ) ) );
    }
    
    public function testContainsAll() {
        $set = new HashSet( new String( 'String' ) );
        $set->add( new String( 'foo' ) );
        $set->add( new String( 'bar' ) );
    
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
        $this->set->add( new String( 'baz' ) );
    
        self::assertTrue( $this->set->containsAll( $set ) );
    
        $otherList = new HashSet( new String( 'String' ) );
        $otherList->add( new String( 'bax' ) );
    
        self::assertFalse( $this->set->containsAll( $otherList ) );
    }
    
    public function testIsEmpty() {
        self::assertTrue( $this->set->isEmpty() );
        $this->set->add( new String( 'foo' ) );
        self::assertFalse( $this->set->isEmpty() );
    }
    
    public function testIterator() {
        self::assertTrue( $this->set->iterator() instanceof \Iterator );
    }
    
    public function testRemove() {
        $item = new String( 'foo' );
        $this->set->add( $item );
        $this->set->remove( $item );
        self::assertEquals( 0, $this->set->size() );
    }
    
    public function testRemoveAll() {
        $set = new HashSet( new String( 'String' ) );
        $set->add( new String( 'foo' ) );
    
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
    
        $this->set->removeAll( $set );
        self::assertEquals( 1, $this->set->size() );
    }
    
    public function testRetainAll() {
        $set = new HashSet( new String( 'String' ) );
        $set->add( new String( 'foo' ) );
    
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
    
        $this->set->retainAll( $set );
        self::assertEquals( 1, $this->set->size() );
    }
    
    public function testToArray() {
        $this->set->add( new String( 'foo' ) );
        $this->set->add( new String( 'bar' ) );
    
        $array = array( new String( 'foo' ), new String( 'bar' ) );
        self::assertEquals( $array, $this->set->toArray() );
    }
}