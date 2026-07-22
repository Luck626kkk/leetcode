<?php
class Solution {

    /**
     * @param Integer[] $target
     * @return Boolean
     */
    function isPossible($target) {
        $n = count($target);
        if ($n === 1) {
            // 如果只有一個數字，它必須是 1 才能成功
            return $target[0] === 1;
        }

        $max = new SplMaxHeap();
        $totalSum = 0; // 【優化】用來記錄整個陣列的總和

        foreach ($target as $value) {
            $max->insert($value);
            $totalSum += $value;
        }

        while (true) {
            $v = $max->extract(); // 抽出目前最大的數
            
            // 如果連最大的數都變成 1 了，代表全陣列都順利還原成 1 了！
            if ($v === 1) {
                return true;
            }

            // 其他人的總和（直接用減的，不需要 clone 堆疊！）
            $otherSum = $totalSum - $v;

            // 異常情況判定：
            // 1. 如果其餘人的和為 0 或小於 0（不可能）
            // 2. 如果最大的數 $v 比其他人的和小，代表它不可能由其餘人加總而來
            if ($otherSum <= 0 || $v < $otherSum) {
                return false;
            }

            // 【優化】用取模代替連續減法，快速算出還原後的數字
            $left = $v % $otherSum;

            // 特殊邊界：如果餘數是 0，代表上一輪這個位置的數應該是 $otherSum。
            // 但如果其餘和 $otherSum 不是 1，代表我們無法還原回 1，直接回傳 false
            if ($left === 0) {
                return $otherSum === 1;
            }

            // 將還原後的新數字放回堆疊
            $max->insert($left);
            
            // 更新陣列的總和
            $totalSum = $otherSum + $left;
        }
    }
}