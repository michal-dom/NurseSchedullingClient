<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-03
 * Time: 12:21
 */

class Nurse
{
    private $id;
    private $name;
    private $surname;
    private $type;
    private $hours;

    /**
     * Nurse constructor.
     * @param $id
     * @param $name
     * @param $surname
     * @param $type
     */
    public function __construct(int $id, string $name, string $surname, string $type, int $hours)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->type = $type;
        $this->hours = $hours;
    }


}