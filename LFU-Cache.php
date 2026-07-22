<?php

class LFUCache {
    private $capacity;
    private $minFreq = 0; // 紀錄目前最低的頻率
    private $values = []; // [key => value]
    private $keyToFreq = []; // [key => freq]
    private $freqToKeys = []; // [freq => [key1 => true, key2 => true]]

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
        if (!isset($this->values[$key])) {
            return -1;
        }

        // 升遷機制：增加使用頻率
        $this->promote($key);

        return $this->values[$key];
    }
  
    /**
     * @param Integer $key
     * @param Integer $value
     * @return NULL
     */
    function put($key, $value) {
        if ($this->capacity <= 0) return;

        // 情況 1：Key 已經存在，直接更新數值並升遷
        if (isset($this->values[$key])) {
            $this->values[$key] = $value;
            $this->promote($key);
            return;
        }

        // 情況 2：快取滿了，需要淘汰「最少使用」且「最久未使用」的人
        if (count($this->values) >= $this->capacity) {
            // 1. 從最低頻率的箱子裡，抓出最前面（最久沒用）的那個 Key
            $evictKey = array_key_first($this->freqToKeys[$this->minFreq]);
            
            // 2. 徹底把牠從各個記錄中抹除
            unset($this->values[$evictKey]);
            unset($this->keyToFreq[$evictKey]);
            unset($this->freqToKeys[$this->minFreq][$evictKey]);
        }

        // 情況 3：寫入全新 Key
        $this->values[$key] = $value;
        $this->keyToFreq[$key] = 1;
        $this->freqToKeys[1][$key] = true; // 放進頻率為 1 的箱子尾端
        $this->minFreq = 1; // 因為新加入的頻率一定是 1，所以 minFreq 必定重設為 1
    }

    /**
     * 核心輔助：將 Key 的頻率加 1，並搬移到對應的頻率箱子
     */
    private function promote($key) {
        $freq = $this->keyToFreq[$key];      // 拿到舊頻率
        $nextFreq = $freq + 1;               // 計算新頻率

        $this->keyToFreq[$key] = $nextFreq;  // 更新頻率記錄

        // 1. 從舊的頻率箱子移除
        unset($this->freqToKeys[$freq][$key]);

        // 2. 塞進新的頻率箱子尾端
        $this->freqToKeys[$nextFreq][$key] = true;

        // 3. 【關鍵】維護最小頻率 $minFreq 的正確性
        // 如果剛好移除的是最小頻率，且該頻率箱子空了，代表最低頻率要往上提 1 級
        if ($freq === $this->minFreq && empty($this->freqToKeys[$freq])) {
            unset($this->freqToKeys[$freq]); // 釋放記憶體
            $this->minFreq++;
        }
    }
}