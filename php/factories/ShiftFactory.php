<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-06-01
 * Time: 17:53
 */

require_once ("Factory.php");
require_once '../models/Shift.php';

class ShiftFactory extends Factory
{

    public function createObject(array $row): Entity
    {
        // TODO: Implement createObject() method.

        $shift = new Shift( strtotime($row['date']),
            (int) $row['id_nurse'],
            (int) $row['id_shift']);

        return $shift;

    }
}