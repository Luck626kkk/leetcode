<?php

class Solution {

    /**
     * @param Integer[] $students
     * @param Integer[] $sandwiches
     * @return Integer
     */
    function countStudents($students, $sandwiches) {
       

        while(count($students) > 0){
            $item = array_shift($students);

            if($item !== $sandwiches[array_keys($sandwiches)[0]]){
                $students[] = $item;
            }else{
                unset($sandwiches[array_keys($sandwiches)[0]]);
            }
            $cnt = array_count_values($students);
            if(count($cnt) === 1 && $sandwiches[array_keys($sandwiches)[0]] !== $students[array_keys($students)[0]]){
                break;
            }
        }

        return count($students);

        $count = [0 => 0, 1 => 0];
        foreach ($students as $student) {
            $count[$student]++;
        }

        // 2. 依序看三明治
        foreach ($sandwiches as $sandwich) {
            // 如果還有想吃這種三明治的學生，就發給他（該種類學生減 1）
            if ($count[$sandwich] > 0) {
                $count[$sandwich]--;
            } else {
                // 如果已經沒有學生想吃這種三明治了，隊伍直接卡死，收工！
                break;
            }
        }

        // 3. 剩下還沒拿走的三明治數量，就是沒吃到飯的學生人數
        return $count[0] + $count[1];
    }
}

$obj = new Solution();
var_dump($obj->countStudents([1,1,0,0],[0,1,0,1]));



