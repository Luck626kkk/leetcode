<?php

class Solution {

    /**
     * @param String[] $tokens
     * @return Integer
     */
    function evalRPN($tokens) {
        $result = 0;

        $boxs = [];
        for($i=0;$i<count($tokens); $i++){
            $value = $tokens[$i];

            if(is_numeric($value)){
                $boxs[] = $value;
            }else{
                $last1 = array_pop($boxs);
                $last2 = array_pop($boxs);
                if($value === "+"){
                    $result = $last1 + $last2;
                }elseif($value === "*"){
                    $result = ($last1 * $last2);
                }elseif($value === "/"){
                   $result = intval($last2 / $last1);
                }elseif($value === "-"){
                   $result = intval($last2 - $last1);
                }



                $boxs[] = $result;
            }

        }

        return count($boxs) > 0 ? $boxs[0] : $result;

        return $result;
    }
}

