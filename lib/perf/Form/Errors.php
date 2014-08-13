<?php

namespace perf\Form;

/**
 *
 *
 * @package perf
 */
class Errors implements \IteratorAggregate, \Countable
{

    /**
     *
     *
     * @var Error[]
     */
    private $errors = array();

    /**
     *
     *
     * @return Errors Fluent return.
     */
    public function clear()
    {
        $this->errors = array();

        return $this;
    }

    /**
     *
     *
     * @param Error $error
     * @return Errors Fluent return.
     */
    public function add(Error $error)
    {
        $this->errors[$error->getId()] = $error;

        return $this;
    }

    /**
     *
     *
     * @return Error[]
     */
    public function get()
    {
        return array_values($this->errors);
    }

    /**
     *
     *
     * @return array
     */
    public function getIds()
    {
        return array_keys($this->errors);
    }

    /**
     *
     *
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists((string) $id, $this->errors);
    }

    /**
     *
     *
     * @return Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->errors);
    }

    /**
     *
     *
     * @return int
     */
    public function count()
    {
        return count($this->errors);
    }
}
