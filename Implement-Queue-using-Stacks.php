<?php
class MyQueue {

    private $queue = [];
    /**
     */
    function __construct() {
        
    }
  
    /**
     * @param Integer $x
     * @return NULL
     */
    function push($x) {
        $this->queue[] = $x;
    }
  
    /**
     * @return Integer
     */
    function pop() {
        return array_shift($this->queue);
    }
  
    /**
     * @return Integer
     */
    function peek() {
        return current($this->queue);
    }
  
    /**
     * @return Boolean
     */
    function empty() {
        return empty($this->queue) ? true:false;
    }
}

/**
 * Your MyQueue object will be instantiated and called as such:
 * $obj = MyQueue();
 * $obj->push($x);
 * $ret_2 = $obj->pop();
 * $ret_3 = $obj->peek();
 * $ret_4 = $obj->empty();
 */