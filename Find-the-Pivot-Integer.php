<?php

class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function pivotInteger(int $n) {
        $res = -1;
        $left = 0;
        $right = 0;
        $leftIndex = 1;
        $rightIndex =(int) $n;

        if($n === 1) return 1;
        for($i=1; $i <= $n; $i++){
            if($left === 0 && $n > 1){
                $left += $leftIndex;
                $right += $rightIndex;

                $leftIndex++;
                $rightIndex--;
                continue;
            }

            if($right >= $left){
                $left += $leftIndex;
                $leftIndex++;
            }else{
                $right += $rightIndex;
                $rightIndex--;
            }

            if($right === $left && $leftIndex === $rightIndex){
                $res = $leftIndex;
                break;
            }
        }

        return $res;
    }
}

$obj = new Solution;
var_dump($obj->pivotInteger(8));