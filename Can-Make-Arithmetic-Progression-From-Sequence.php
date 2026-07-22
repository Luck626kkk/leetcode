<?php
class Solution {

    /**
     * @param Integer[] $arr
     * @return Boolean
     */
    function canMakeArithmeticProgression($arr) {
        asort($arr);
       $arr = array_values($arr);
        
        $res = true;
        $dif = 0;
        foreach($arr as $k => $v){
            if($k === count($arr) - 1) break;
            if($k === 0){
                $dif = abs($arr[$k+1] - $v);
            }else{
                $_diff = abs($arr[$k+1] - $v);
                if($_diff !== $dif){
                    $res =false;
                    break;
                }
            } 
        }

        return $res;
    }
}
$obj = new Solution;
var_dump($obj->canMakeArithmeticProgression([-68,-96,-12,-40,16]));