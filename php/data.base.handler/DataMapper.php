<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-02
 * Time: 21:15
 */

abstract class DataMapper
{

    protected $pdo;
    protected $factory;

    public function __construct(Factory $factory = null){
        $reg = Connection::getInstance();
        $this->pdo = $reg->getPdo();
        $this->factory = $factory;
    }

    public function find( int $id ):Entity{
        $this->selectStmt()->execute([$id]);
        $row = $this->selectStmt()->fetch();

        if(!is_array($row)){
            return null;
        }

        $this->selectStmt()->closeCursor();
        if(!isset($row['id'])){
            return null;
        }
        $object = $this->factory->createObject($row);
        return $object;


    }

    public function findAll():Collection{
        $this->selectAllStmt()->execute([]);
        return $this->getCollection($this->selectAllStmt()->fetchAll());
    }

    public function insert(Entity $object){
        $this->doInsert($object);
    }

    abstract protected function selectStmt(): \PDOStatement;
    abstract protected function selectAllStmt(): \PDOStatement;
    abstract protected function getCollection(array $raw): Collection;
    abstract protected function doInsert(Entity $object);
    abstract public function update(Entity $object);
    abstract protected function targetClass():string;
}