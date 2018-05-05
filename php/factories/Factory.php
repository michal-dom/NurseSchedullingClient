<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 14:00
 */

require_once '../models/Entity.php';

abstract class Factory
{
    abstract public function createObject(array $row):Entity;
}