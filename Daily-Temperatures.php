<?php
class Solution {

    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    function dailyTemperatures($temperatures) {
        $n = count($temperatures);
        $result = array_fill(0,$n,0);
        $stack = [];
        foreach($temperatures as $k => $val){
            
            while(!empty($stack) && $val > $temperatures[end($stack)]){
                $prev = array_pop($stack);
                $result[$prev] = $k - $prev;
            }

            $stack[] = $k;
        }

        return $result;
        
    }
}

$obj = new Solution;
var_dump($obj->dailyTemperatures([73,74,75,71,69,72,76,73]));