<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 15:40
 */

require_once 'DataMapper.php';
require_once '../factories/NurseFactory.php';
require_once '../models/Nurse.php';

class NurseMapper extends DataMapper
{

    private $select_stmt;
    private $select_all_stmt;
    private $update_stmt;
    private $insert_stmt;

    public function __construct(Factory $factory = null)
    {
        parent::__construct($factory);
        $this->select_stmt = $this->pdo->prepare(
            "SELECT * FROM nurses WHERE id_nurse=?"
        );

        $this->update_stmt = $this->pdo->prepare(
            "UPDATE nurses SET id_nurse=?, name=?, surname=?, type=?, hours=? WHERE id_nurse=?"
        );

        $this->insert_stmt = $this->pdo->prepare(
            "INSERT INTO nurses ( name, surname, type, hours ) VALUES( ?, ? )"
        );

        $this->select_all_stmt = $this->pdo->prepare(
            "SELECT * FROM nurses"
        );
    }

    protected function selectStmt(): \PDOStatement
    {
        // TODO: Implement selectStmt() method.
        return $this->select_stmt;
    }

    protected function selectAllStmt(): \PDOStatement
    {
        // TODO: Implement selectAllStmt() method.
        return $this->select_all_stmt;
    }

    protected function getCollection(array $raw): Collection
    {
        // TODO: Implement getCollection() method.
        $factory = new NurseFactory();
        $collection = new Collection($raw, $factory, Nurse::class);
        //$collection->createAll();
        return $collection;
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
        return Nurse::class;
    }
}