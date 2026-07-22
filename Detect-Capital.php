<?php

class Solution {

    /**
     * @param String $word
     * @return Boolean
     */
    function detectCapitalUse($word) {
       
        $len = strlen($word);
        if($len === 1) return true;
        $arr = str_split($word);

       
        $lower0 = $this->chkLower($arr[0]);
        $lower1 = $this->chkLower($arr[1]);

        $mode = 0;
        if($lower0 && $lower1){
            $mode = 2;
        }elseif(!$lower0 && !$lower1){
            $mode = 1;
        }elseif(!$lower0 && $lower1){
            $mode = 3;
        }

        if($mode === 0) return false;

        for($i=2; $i<$len;$i++){
            $lower = $this->chkLower($arr[$i]);
            if($mode === 1 &&  $lower){
                return false;
            }elseif(($mode === 2 or $mode === 3) && !$lower){
                return false;
            }
        }

        return true;

    }

    function chkLower(string $char) : bool
    {
        return $char === mb_strtolower($char, 'UTF-8');
    }
}



$obj = new Solution;
var_dump($obj->detectCapitalUse("FlaG"));