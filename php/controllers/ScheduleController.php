

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
require_once ("../data.base.handler/NurseMapper.php");


$string = file_get_contents("../../data.json");


function tdString(Shift $shift, Nurse $nurse):string{

    $string = "";
    $string .= "<td class='".$shift->getNurse()."'>";
    $string .= "<div class='date'>".date("d",$shift->getDate())."<br/>".date("M",$shift->getDate())."</div><div>";
    $string .= $nurse->getName();
    $string .= "<br />";
    $string .= $nurse->getSurname();
    $string .= "</div></td>";

    return $string;

}

if(isset($_POST)){

    if($_POST['opt'] == 1 ){

        $shift_mapper = new ShiftMapper();
        $collection = $shift_mapper->selectWeek($_POST['date_from']);
        $collection->createAll();
        $nurse_mapper = new NurseMapper();
        $nurse_collection = $nurse_mapper->findAll();
        $nurse_collection->createAll();

        echo "<table id=\"tab-sched-1\">";
        echo "<tr> <td class='td-header'>Time</td> <td class='td-header'>Mo</td> <td class='td-header'>Tu</td> <td class='td-header'>We</td> <td class='td-header'>Th</td> <td class='td-header'>Fr</td> <td class='td-header'>Sa</td> <td class='td-header'>Su</td> </tr>";
        $ex = 0;
        for($i = 0; $i < 10; $i++){
            echo "<tr>";
            echo "<td ><div>".date("H:i",$collection->getRow($i)->getDate())."</div></td>";
            echo tdString($collection->getRow($i), $nurse_collection->getRow($collection->getRow($i)->getNurse()-1));
            echo tdString($collection->getRow($i+10), $nurse_collection->getRow($collection->getRow($i+10)->getNurse()-1));
            echo tdString($collection->getRow($i+20), $nurse_collection->getRow($collection->getRow($i+20)->getNurse()-1));
            echo tdString($collection->getRow($i+30), $nurse_collection->getRow($collection->getRow($i+30)->getNurse()-1));
            echo tdString($collection->getRow($i+40), $nurse_collection->getRow($collection->getRow($i+40)->getNurse()-1));

            if($i == 2 || $i == 5 || $i == 8){
                echo "<td> </td>";
                echo "<td> </td>";
            }else{
                if($i > 2) $ex = 1;
                if($i > 5) $ex = 2;
                if($i > 8) $ex = 3;
                echo tdString($collection->getRow($i+50-$ex), $nurse_collection->getRow($collection->getRow($i+50-$ex)->getNurse()-1));
                echo tdString($collection->getRow($i+57-$ex), $nurse_collection->getRow($collection->getRow($i+57-$ex)->getNurse()-1));
                //echo "<td class=''".$collection->getRow($i)->getNurse()."'>".$nurse_collection->getRow($collection->getRow($i+50)->getNurse()-1)->getName()."<br />".$nurse_collection->getRow($collection->getRow($i+10)->getNurse()-1)->getSurname()."</td>";
                //echo "<td class=''".$collection->getRow($i)->getNurse()."'>".$nurse_collection->getRow($collection->getRow($i+57)->getNurse()-1)->getName()."<br />".$nurse_collection->getRow($collection->getRow($i+10)->getNurse()-1)->getSurname()."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }


    if($_POST['opt'] == 2 ){
        $nurse_id = $_POST['nurse_id'];

        $shift_mapper = new ShiftMapper();
        $collection = $shift_mapper->selectWeekForNurse($_POST['date_from'], $nurse_id);
        $collection->createAll();

        $nurse_mapper = new NurseMapper();
        $nurse_collection = $nurse_mapper->findAll();
        $nurse_collection->createAll();

        $days = array();
        $hours = array();

        for($i = 0; $i < $collection->getTotal(); $i++ ){
            array_push($days, ((int) date("N",$collection->getRow($i)->getDate()))-1);
            array_push($hours, (int) date("H",$collection->getRow($i)->getDate()));

        }

        $day_names = array(
            0 => 'Mo',
            1 => 'Tu',
            2 => 'We',
            3 => 'Th',
            4 => 'Fr',
            5 => 'Sa',
            6 => 'Su',
        );

        echo "<table id='tab-sched-3' style=\"width: 100%\">";
        echo "<tr>";
        echo "<td class='tdh'>Day</td>";
        for ($i = 0; $i < 24; $i++ ) {
            echo "<td class='td-h'>" . date("h:i", mktime($i, 0, 0))." <br>-<br> ". date("h:i", mktime($i+1, 0, 0)) . "</td>";
        }
        echo "</tr>";
        $counter = 0;

        $k = 0;
        for ($i = 0; $i < 7; $i++ ) {
            echo "<tr>";
            echo "<td>".$day_names[$i % 7] ."</td>";
            for ($j = 0; $j < 24; $j++) {
                if(in_array($i, $days)) {

                    $key = array_search($i, $days);
                    if($hours[$key] == $j ){
                        $counter = 8;
                    }
                    if($counter > 0) {
                        $counter--;
                        echo "<td class='working'></td>";
                    } else {
                        echo "<td class='day-off'></td>";
                    }

                }
//                if(in_array($i, $days)) {
//                    echo "<td class='working'>day = $i hour = $j</td>";
//                    $key = array_search($i, $days);
//                    if($hours[$key] == $j ){
//                        $counter = 8;
//                    }
//                }
//                if($counter > 0) {
//                    $counter--;
//                    echo "<td class='working'>day = $i hour = $j</td>";
//                } else {
//                    echo "<td class='day-off'>day = $i hour = $j</td>";
//                }
            }
            echo "</tr>";

        }
        echo "</table>";


    }
    if($_POST['opt'] == 3 ) {

    }



    if($_POST['opt'] == 4 ) {
        $nurse_id = $_POST['nurse_id'];

        $shift_mapper = new ShiftMapper();
        $shifts_collection = $shift_mapper->selectWeekForNurse($_POST['date_from'], $nurse_id, 1);
        $shifts_collection->createAll();


        $shift_names = array(
            1 => 'Early',
            2 => 'Day',
            3 => 'Late',
            4 => 'Night'
        );

        for($i = 0; $i < $shifts_collection->getTotal(); $i++ ){
//            echo $shifts_collection->getRow($i);
//            date("Y-m-d H:i:s",$this->date) . " " . $this->nurse . " " . $this->type;
            echo "<div class='card card-$i'> <span class='date-card'>".date("d M",$shifts_collection->getRow($i)->getDate())."</span><br />";
            echo "<span>Start at: ".date("h:i",$shifts_collection->getRow($i)->getDate())."</span><br>";
            $style = "style='bottom:";
            $style .= rand(-10, 5);
            $style .= "px;";
            $style .= " left:";
            $style .= rand(-5, 5);
            $style .= "px;'";
            echo " <span class='shift-card shift-card-".$shifts_collection->getRow($i)->getType()."'>".$shift_names[$shifts_collection->getRow($i)->getType()]."</span>";

            echo "</div><br>";
//            echo (int) date("H",$collection->getRow($i)->getDate());
//            echo "<br>";
//            echo (int) date("N",$collection->getRow($i)->getDate());
//            array_push($days, ((int) date("N",$collection->getRow($i)->getDate()))-2);
//            array_push($hours, (int) date("H",$collection->getRow($i)->getDate()));
//            echo "<br>";

        }
    }


}


//$shift_mapper = new ShiftMapper();
////$collection = new Collection();
//
//
//$collection = $shift_mapper->selectInterval("2018-05-08 07:00:00");
//$collection->createAll();
//
//echo $collection->getTotal();
//echo "<br>";
//echo $collection->getRow(0);

//for ($i = 0; $i < $collection->getTotal(); $i++){
//    echo "<br>";
//    echo $collection->getRow($i);
//}

//foreach ($collection as $elem){
//    echo $elem;
//    echo "<br>";
//}



//
//$json_a = json_decode($string, true);
//
////print_r($json_a);
//$year = 2018;
//$month = 5;
//$dday = 7;
//
//
//$shift_mapper = new ShiftMapper();
//
//$shift_list = new ArrayList($shift_mapper, Shift::class);
//
//
//foreach ($json_a as $i => $week){
//    echo "<br />$i: <br />";
//    foreach ($week as $j => $day){
//        echo "<br />$j: <br />";
//        print_r($day);
//        $dday++;
//        foreach ($day as $k => $sh){
//            if($j == "day6" || $j == "day5"){
//                if(in_array($k, [0,1])){
//                    $shift = new Shift(mktime(7, 0, 0, $month, $dday, $year), $sh, 1);
//                } else if(in_array($k, [2,3])){
//                    $shift = new Shift(mktime(8, 0, 0, $month, $dday, $year), $sh, 2);
//                } else if(in_array($k, [4,5])){
//                    $shift = new Shift(mktime(14, 0, 0, $month, $dday, $year), $sh, 3);
//                } else {
//                    $shift = new Shift(mktime(23, 0, 0, $month, $dday, $year), $sh, 4);
//                }
//
//            }else{
//                if(in_array($k, [0,1,2])){
//                    $shift = new Shift(mktime(7, 0, 0, $month, $dday, $year), $sh, 1);
//                } else if(in_array($k, [3,4,5])){
//                    $shift = new Shift(mktime(8, 0, 0, $month, $dday, $year), $sh, 2);
//                } else if(in_array($k, [6,7,8])){
//                    $shift = new Shift(mktime(14, 0, 0, $month, $dday, $year), $sh, 3);
//                } else {
//                    $shift = new Shift(mktime(23, 0, 0, $month, $dday, $year), $sh, 4);
//                }
//            }
//
//            $shift_list->push($shift);
//
//
//        }
//    }
//}



//$shift_list->printAll();
//$shift_list->insertAll();
?>