<?php
class Solution {

    /**
     * @param Integer $n
     * @return Boolean
     */
    function isUgly($n) {
        if($n <=0) return false;
        if($n === 1) return true;
        $res = false;
        while($n >= 1){
            if($n === 1){
                $res = true;
                break;
            } 

            if($n % 2 === 0){
                $n = $n/2;
            }elseif($n % 3 === 0){
                $n = $n/3;
            }elseif($n % 5 === 0){
                $n = $n/5;
            }else{
                break;
            }
        }

        return $res;
    }
}