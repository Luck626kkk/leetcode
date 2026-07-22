<?php
class LRUCache {
    private $capacity;
    private $cache = [];

    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
        $this->capacity = $capacity;
    }
  
    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
        if (!isset($this->cache[$key])) {
            return -1;
        }

        // 【關鍵步驟】既然被 get 了，代表它最新鮮
        $value = $this->cache[$key];
        unset($this->cache[$key]);     // 1. 先把它從原本的位置拔掉
        $this->cache[$key] = $value;   // 2. 重新放進去，它會自動跑到陣列最後面（尾部）

        return $value;
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if (isset($this->cache[$key])) {
            // 如果 Key 已經存在，先拔掉舊的，準備等一下更新位置
            unset($this->cache[$key]);
        } elseif (count($this->cache) >= $this->capacity) {
            // 如果容量滿了，淘汰最久沒用的人（也就是陣列的第一個元素）
            $oldestKey = array_key_first($this->cache);
            unset($this->cache[$oldestKey]);
        }

        // 寫入新值（它會自動排在陣列的最後面，成為最新鮮的）
        $this->cache[$key] = $value;
    }
}