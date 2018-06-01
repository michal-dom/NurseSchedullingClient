<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-05
 * Time: 15:07
 */

require_once 'Entity.php';
require_once '../factories/Factory.php';

class Collection implements \Iterator
{

    private $factory;
    private $total = 0;
    private $raw = [];
    private $pointer = 0;
    private $objects = [];
    private $class;

    public function __construct(array $raw = [], Factory $factory = null, string $class)
    {
        $this->raw = $raw;
        $this->total = count($raw);
        if(count($raw) && is_null($factory)){
            error_log("pusty obiekt mapper");
        }
        $this->factory = $factory;
        $this->class = $class;
    }

    public function createAll(){
        $i = 0;
        foreach ($this->raw as $row){
            $entity = $this->factory->createObject($row);
            $this->objects[$i] = $entity;
            $i++;
        }
    }

    public function add(Entity $object){
        $class = $this->class;
//        $class = $this->targetClass();
        if(!($object instanceof $class)){
            error_log("instancja zlej klasy");
        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;

    }

    public function getTotal(): int
    {
        return $this->total;
    }


    public function getRow($num)
    {
        $this->notifyAccess();
        if ($num >= $this->total || $num < 0) {
            return null;
        }
        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }
        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->factory->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
    }


    protected function notifyAccess(){
        //
    }
    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        // TODO: Implement current() method.
        return $this->getRow(($this->pointer));
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        // TODO: Implement next() method.
        $row = $this->getRow($this->pointer);
        if(! is_null($row)){
            $this->pointer++;
        }
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        // TODO: Implement key() method.
        return $this->pointer;

    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        // TODO: Implement valid() method.
        return (! is_null($this->current()));
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        // TODO: Implement rewind() method.
        $this->total = 0;

    }
}