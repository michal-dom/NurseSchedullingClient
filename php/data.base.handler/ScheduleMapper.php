<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-31
 * Time: 13:10
 */

require_once ('DataMapper.php');


class ScheduleMapper extends DataMapper
{

    protected function selectStmt(): \PDOStatement
    {
        // TODO: Implement selectStmt() method.
    }

    protected function selectAllStmt(): \PDOStatement
    {
        // TODO: Implement selectAllStmt() method.
    }

    protected function getCollection(array $raw): Collection
    {
        // TODO: Implement getCollection() method.
    }

    protected function doInsert(Entity $object)
    {
        // TODO: Implement doInsert() method.
    }

    public function update(Entity $object)
    {
        // TODO: Implement update() method.
    }

    protected function targetClass(): string
    {
        // TODO: Implement targetClass() method.
    }
}