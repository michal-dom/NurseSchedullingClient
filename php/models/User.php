<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-03
 * Time: 12:21
 */

class User
{
    private $mail;
    private $pass;
    private $id;

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getMail():string
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }



}