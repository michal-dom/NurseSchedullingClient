<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-31
 * Time: 13:23
 */

require_once ("../models/ArrayList.php");
require_once ("../models/Shift.php");
require_once ("../data.base.handler/ShiftMapper.php");


$string = file_get_contents("../../data.json");
$json_a = json_decode($string, true);

//print_r($json_a);
$year = 2018;
$month = 5;
$dday = 7;

$date = date("r", mktime(0, 0, 0, $month, 100, $year));

$shift_mapper = new ShiftMapper();

$shift_list = new ArrayList($shift_mapper, Shift::class);

echo $date;

foreach ($json_a as $i => $week){
    echo "<br />$i: <br />";
    foreach ($week as $j => $day){
        echo "<br />$j: <br />";
        print_r($day);
        $dday++;
        foreach ($day as $k => $sh){
            if($j == "day6" || $j == "day5"){
                if(in_array($k, [0,1])){
                    $shift = new Shift(mktime(7, 0, 0, $month, $dday, $year), $sh, 1);
                } else if(in_array($k, [2,3])){
                    $shift = new Shift(mktime(8, 0, 0, $month, $dday, $year), $sh, 2);
                } else if(in_array($k, [4,5])){
                    $shift = new Shift(mktime(14, 0, 0, $month, $dday, $year), $sh, 3);
                } else {
                    $shift = new Shift(mktime(23, 0, 0, $month, $dday, $year), $sh, 4);
                }

            }else{
                if(in_array($k, [0,1,2])){
                    $shift = new Shift(mktime(7, 0, 0, $month, $dday, $year), $sh, 1);
                } else if(in_array($k, [3,4,5])){
                    $shift = new Shift(mktime(8, 0, 0, $month, $dday, $year), $sh, 2);
                } else if(in_array($k, [6,7,8])){
                    $shift = new Shift(mktime(14, 0, 0, $month, $dday, $year), $sh, 3);
                } else {
                    $shift = new Shift(mktime(23, 0, 0, $month, $dday, $year), $sh, 4);
                }
            }

            $shift_list->push($shift);


        }
    }
}

//$shift_list->printAll();
$shift_list->insertAll();
