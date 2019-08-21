<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 17.08.2019
 * Time: 12:33
 */
define('MIN_TEMPERATURE', -273);
define('MAX_TEMPERATURE', 5526);
function randomArray($size){
    $array = [];
    for ($i = 0; $i < $size; $i ++){
        $array[$i] = mt_rand(MIN_TEMPERATURE, MAX_TEMPERATURE);
    }
    return $array;
}
function minTemperature($array){
    if (count($array) == 0) $nearZero = 0;
    
}