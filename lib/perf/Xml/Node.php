<?php

namespace perf\Xml;

/**
 *
 *
 * @package perf
 */
class Node implements \Iterator, \Countable
{

    /**
     *
     *
     * @var array
     */
    private $children = array();

    /**
     * Current iteration index.
     *
     * @var int
     */
    private $index = 0;

    /**
     * Constructor.
     *
     * @param array $array
     * @return void
     */
    protected function __construct(array $array)
    {
        foreach ($array as $key => $value) {
            $this->__set($key, $value);
        }
    }

    /**
     *
     *
     * @param string $var
     * @param mixed $value
     * @return void
     */
    public function __set($var, $value)
    {
        $this->children[$var] = is_array($value)
                              ? new self($value)
                              : $value;
    }

    /**
     *
     *
     * @param string $var
     * @return mixed
     * @throws \DomainException
     */
    public function __get($var)
    {
        if (array_key_exists($var, $this->children)) {
            return $this->children[$var];
        }

        throw new \DomainException();
    }

    /**
     *
     *
     * @return void
     */
    public function __clone()
    {
        $children = array();

        foreach ($this->children as $key => $value) {
            $children[$key] = ($value instanceof self)
                            ? clone $value
                            : $value;
        }

        $this->children = $children;
    }

    /**
     *
     *
     * @return mixed
     */
    public function current()
    {
        return current($this->children);
    }

    /**
     *
     *
     * @return mixed
     */
    public function key()
    {
        return key($this->children);
    }

    /**
     *
     *
     * @return void
     */
    public function next()
    {
        next($this->children);

        ++$this->index;
    }

    /**
     *
     *
     * @return void
     */
    public function rewind()
    {
        reset($this->children);

        $this->index = 0;
    }

    /**
     *
     *
     * @return bool
     */
    public function valid()
    {
        return ($this->index < count($this->children));
    }

    /**
     *
     *
     * @return int
     */
    public function count()
    {
        return count($this->children);
    }
}
