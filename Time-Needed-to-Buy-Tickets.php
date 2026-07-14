<?php
class Solution {

    /**
     * @param Integer[] $tickets
     * @param Integer $k
     * @return Integer
     */
    function timeRequiredToBuy($tickets, $k) {
        $total = 0;
        $target = $tickets[$k];

        foreach ($tickets as $i => $t) {
            if ($i <= $k) {
                $total += min($t, $target);
            } else {
                $total += min($t, $target - 1);
            }
        }

        return $total;
    }
}

$obj = new Solution();
var_dump($obj->timeRequiredToBuy([2,3,2],2));