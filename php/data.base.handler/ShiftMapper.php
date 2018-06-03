<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-06-01
 * Time: 11:05
 */

require_once ('DataMapper.php');
require_once ('../factories/ShiftFactory.php');

class ShiftMapper extends DataMapper
{

    private $select_stmt;
    private $select_all_stmt;
    private $select_week_stmt;
    private $update_stmt;
    private $insert_stmt;
    private $select_nurse_week_stmt;

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
            "INSERT INTO nurse_x_shitf ( id_nurse, id_shift, date ) VALUES( ?, ?, ? )"
        );

        $this->select_all_stmt = $this->pdo->prepare(
            "SELECT * FROM nurse_x_shitf"
        );
        $this->select_week_stmt = $this->pdo->prepare(
            "SELECT * FROM nurse_x_shitf WHERE date >= ? AND date <= ?"
        );
        $this->select_nurse_week_stmt = $this->pdo->prepare(
            "SELECT * FROM nurse_x_shitf WHERE date >= ? AND date < ? AND id_nurse = ?"
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

    public function selectWeek(string $date_from):Collection{
        $date_to = date("Y-m-d H:i:s",strtotime($date_from . "+7 days") );
        $values = [
            $date_from,
            $date_to
        ];

        $this->select_week_stmt->execute($values);
        return $this->getCollection($this->select_week_stmt->fetchAll());
    }

    public function selectWeekForNurse(string $date_from, int $nurse_id, int $month = 0):Collection{
        if($month == 0){
            $date_to = date("Y-m-d H:i:s",strtotime($date_from . "+7 days") );
        }else{
            $date_to = date("Y-m-d H:i:s",strtotime($date_from . "+30 days") );
        }

        $values = [
            $date_from,
            $date_to,
            $nurse_id
        ];

        $this->select_nurse_week_stmt->execute($values);
        return $this->getCollection($this->select_nurse_week_stmt->fetchAll());
    }

    protected function getCollection(array $raw): Collection
    {
        // TODO: Implement getCollection() method.
        $factory = new ShiftFactory();
        $collection = new Collection($raw, $factory, Shift::class);
        return $collection;
    }

    protected function doInsert(Entity $object)
    {
        // TODO: Implement doInsert() method.
        $values = [
            $object->getNurse(),
            $object->getType(),
            date("Y-m-d H:i:s", $object->getDate())
        ];
        //cho date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s", $object->getDate()) . "+35 days"));

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