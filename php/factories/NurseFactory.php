<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 14:02
 */

require_once 'Factory.php';
require_once '../models/Nurse.php';

class NurseFactory extends Factory
{


    public function createObject(array $row): Entity
    {
        // TODO: Implement createObject() method.

        $nurse = new Nurse((int) $row['id'],
            (string) $row['name'],
            (string) $row['surname'],
            (string) $row['type'],
            (int) $row['work_hours']);
        return $nurse;
    }
}