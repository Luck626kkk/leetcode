<?php

// var_dump(reverseStr("supermicro"));
// var_dump(reverseOdd("abcdefg"));
// var_dump(reverseOddArr([3, 8, 1, 6, 5, 7, 2]));
var_dump(splitStrNum("a1b2c3d4"));

function reverseStr(string $str) :string
{
    $res = "";
    $cnt = strlen($str);
    $arr = str_split($str);
    for($i = $cnt; $i > 0; $i--){
        $res .= $arr[$i -1];
    }

    return $res;
}

function reverseOdd(string $str) :string
{
    $arr = str_split($str);
    $odd = [];
    foreach($arr as $k => $v){
        if($k % 2 !== 0) $odd[] = $v;
    }
    $res ="";
    foreach($arr as $k => $v){
        if($k % 2 === 0 ){
            $res .= $v;
        }else{
            $res .= array_pop($odd);
        }
    }

    return $res;
}

function reverseOddArr(array $arr):array
{
    $odd = [];
    foreach($arr as $k => $v){
        if($v % 2 !== 0) $odd[] = $v;
    }
    $res = [];
    foreach($arr as $k => $v){
        if($v % 2 === 0){
        $res[] = $v;
        }else{
        $res[] = array_pop($odd);
        }
    }

    return $res;
}

function splitStrNum(string $str) :string
{
    $arr = str_split($str);
    $strArr = [];
    $numArr = [];
    foreach($arr as $k => $v){
        if(is_numeric($v)){
            $numArr[] = $v;
        }else{
            $strArr[] = $v;
        }
    }
    
    return implode("",$strArr) . implode("",$numArr);
}