<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-31
 * Time: 15:16
 */

class ArrayList implements \Iterator
{

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    private $list = array();
    private $index;
    private $mapper;
    private $class_name;

    public function __construct(DataMapper $mapper, string $class_name)
    {
        $this->class_name = $class_name;
        $this->mapper = $mapper;
    }

    public function push(Entity $e)
    {
        array_push($this->list, $e);
    }

    public function get(int $i): Entity
    {
        if ($this->index <= $i) {
            return null;
        }

        return $this->list[$i];
    }

    public function printAll()
    {
        foreach ($this->list as $i => $elem) {
            echo $elem;
        }
    }

    public function insertAll()
    {
        foreach ($this->list as $i => $elem) {
            $this->mapper->insert($elem);
        }
    }


    public function current(): Entity
    {
        // TODO: Implement current() method.

        return $this->list[$this->index];


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
        $this->index++;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key(): int
    {
        // TODO: Implement key() method.
        return $this->index;
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
        return isset($this->list[$this->key()]);
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
        $this->index = 0;
    }

    public function reverse()
    {
        $this->list = array_reverse($this->list);
        $this->rewind();
    }
}