<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 13:56
 */

require_once ("Entity.php");

class Shift extends Entity
{
    private $date;
    private $nurse;
    private $type;

    /**
     * Shift constructor.
     * @param $date
     * @param $nurse
     * @param $type
     */
    public function __construct(int $date, int $nurse, int $type)
    {
        $this->date = $date;
        $this->nurse = $nurse;
        $this->type = $type;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return date("Y-m-d H:i:s",$this->date) . " " . $this->nurse . " " . $this->type;
    }


    /**
     * @return mixed
     */
    public function getDate():int
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
    public function getNurse():int
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
    public function getType():int
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