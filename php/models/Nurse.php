<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-03
 * Time: 12:21
 */

class Nurse extends Entity
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


    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name . " " . $this->surname;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours)
    {
        $this->hours = $hours;
    }


}