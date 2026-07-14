<?php

class Solution {

    /**
     * @param Integer[] $heights
     * @return Integer
     */
    function largestRectangleArea($heights) {
        $stack = [];
        $maxArea = 0;
        $n = count($heights);

        for ($i = 0; $i <= $n; $i++) {
            $h = ($i == $n) ? 0 : $heights[$i];

            while (!empty($stack) && $heights[end($stack)] >= $h) {
                $top = array_pop($stack);
                $height = $heights[$top];
                $left = empty($stack) ? -1 : end($stack);
                $width = $i - $left - 1;
                $maxArea = max($maxArea, $height * $width);
            }

            $stack[] = $i;
        }

        return $maxArea;
    }
}
// $a = [5,2,4];
// var_dump(end($a));
// var_dump($a);
// exit;
$obj = new Solution;
var_dump($obj->largestRectangleArea([2,0,1,5,6,2,3]));
