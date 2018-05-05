<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 13:56
 */

class Shift
{
    private $date;
    private $nurse;
    private $type;

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getNurse()
    {
        return $this->nurse;
    }

    /**
     * @param mixed $nurse
     */
    public function setNurse($nurse)
    {
        $this->nurse = $nurse;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



}