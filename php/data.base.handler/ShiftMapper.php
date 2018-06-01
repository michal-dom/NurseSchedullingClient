<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-06-01
 * Time: 11:05
 */

require_once ('DataMapper.php');

class ShiftMapper extends DataMapper
{

    private $select_stmt;
    private $select_all_stmt;
    private $update_stmt;
    private $insert_stmt;

    public function __construct(Factory $factory = null)
    {
        parent::__construct($factory);
        $this->select_stmt = $this->pdo->prepare(
            "SELECT * FROM nurse_x_shitf WHERE id=?"
        );

        $this->update_stmt = $this->pdo->prepare(
            "UPDATE nurse_x_shitf SET id=?, id_nurse=?, id_shift=?, date=? WHERE id=?"
        );

        $this->insert_stmt = $this->pdo->prepare(
            "INSERT INTO nurse_x_shitf ( id_nurse, id_shift, date ) VALUES( ?, ?, 1388516401 )"
        );

        $this->select_all_stmt = $this->pdo->prepare(
            "SELECT * FROM nurse_x_shitf"
        );
    }

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
        $values = [
            $object->getNurse(),
            $object->getType()
        ];
//        date("Y-m-d H:i:s", 1388516401);
        echo date("Y-m-d H:i:s", $object->getDate());
        echo "<br />";

        $this->insert_stmt->execute($values);
        $id = $this->pdo->lastInsertId();
        //$object->setId((int)$id);

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