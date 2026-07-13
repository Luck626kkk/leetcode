<?php
class Solution {

    /**
     * @param Integer $n
     * @param String[] $logs
     * @return Integer[]
     */
    function exclusiveTime($n, $logs) {

        $result = [];
        $exeArr = [];
        $prevTime = 0;

        foreach($logs as $k => $v){
            $exp = explode(":",$v);
            $name = $exp[0];
            $action = $exp[1];
            $time = $exp[2];

            if(!isset($result[$name])){
                $result[$name] = 0;
            }

            if($action === "start"){
                $id = end($exeArr);
                if (!empty($exeArr) && isset($result[$id])) {
                   
                    $result[$id] += ($time - $prevTime);
                }
                
                // 結算完後，新的人正式進堆疊開始跑
                $exeArr[] = $name;
                $prevTime = $time; // 更新上一次事件時間
            }else{

                $id = array_pop($exeArr);
                $result[$id] += ($time - $prevTime + 1);

                // 因為 end 是在該秒的「結尾」，下一件事情最早只能從下一秒（time + 1）開始算
                $prevTime = $time + 1;
            }
        }
        return $result;
    }
}