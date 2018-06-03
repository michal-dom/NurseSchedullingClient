<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-06-01
 * Time: 16:07
 */

class ScheduleGenerator
{
    private $year = 2018;
    private $month = 5;
    private $day = 7;
    private $json;

    private $shift_mapper;
    private $shift_list;

    public function __construct()
    {
        $this->shift_mapper = new ShiftMapper();
        $this->shift_list = new ArrayList($this->shift_mapper, Shift::class);
    }


    public function generateSchedule()
    {
        $string = file_get_contents("../../data.json");
        $this->json = json_decode($string, true);

        //wysłanie zadania na serwer
    }

    public function saveSchedule()
    {

        foreach ($this->json as $i => $week) {
            echo "<br />$i: <br />";
            foreach ($week as $j => $day) {
                echo "<br />$j: <br />";
                print_r($day);
                $this->day++;
                foreach ($day as $k => $sh) {
                    if ($j == "day6" || $j == "day5") {
                        if (in_array($k, [0, 1])) {
                            $shift = new Shift(mktime(7, 0, 0, $this->month, $this->day, $this->year), $sh, 1);
                        } else if (in_array($k, [2, 3])) {
                            $shift = new Shift(mktime(8, 0, 0, $this->month, $this->day, $this->year), $sh, 2);
                        } else if (in_array($k, [4, 5])) {
                            $shift = new Shift(mktime(14, 0, 0, $this->month, $this->day, $this->year), $sh, 3);
                        } else {
                            $shift = new Shift(mktime(23, 0, 0, $this->month, $this->day, $this->year), $sh, 4);
                        }

                    } else {
                        if (in_array($k, [0, 1, 2])) {
                            $shift = new Shift(mktime(7, 0, 0, $this->month, $this->day, $this->year), $sh, 1);
                        } else if (in_array($k, [3, 4, 5])) {
                            $shift = new Shift(mktime(8, 0, 0, $this->month, $this->day, $this->year), $sh, 2);
                        } else if (in_array($k, [6, 7, 8])) {
                            $shift = new Shift(mktime(14, 0, 0, $this->month, $this->day, $this->year), $sh, 3);
                        } else {
                            $shift = new Shift(mktime(23, 0, 0, $this->month, $this->day, $this->year), $sh, 4);
                        }
                    }

                    $this->shift_list->push($shift);


                }
            }
        }

        $this->shift_list->insertAll();
    }

}