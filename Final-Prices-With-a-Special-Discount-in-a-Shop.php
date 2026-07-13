<?php
class Solution {

    /**
     * @param Integer[] $prices
     * @return Integer[]
     */
    function finalPrices($prices) {
        $result = [];
        foreach($prices as $k => $price){

            foreach($prices as $k2 => $price2){
                if($k2 <= $k)continue;
                if($price2 > $price) continue;

                $result[] = $price - $price2;
                break;
            }

            if(count($result) < ($k + 1)){
                $result[] = $price;
            }
        }
        return $result;
    }
}