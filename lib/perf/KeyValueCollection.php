<?php

namespace perf;

/**
 *
 *
 */
class KeyValueCollection
{

    /**
     *
     *
     * @var {string:mixed}
     */
    private $values = array();

    /**
     * Constructor.
     *
     * @param {string:mixed} $values Key-value pairs.
     * @return void
     */
    public function __construct(array $values = array())
    {
        $this->values = $values;
    }

    /**
     *
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     *
     *
     * @param string $key
     * @return void
     */
    public function remove($key)
    {
        unset($this->values[$key]);
    }

    /**
     *
     *
     * @param string $key
     * @return mixed
     * @throws \DomainException
     */
    public function get($key)
    {
        if ($this->has($key)) {
            return $this->values[$key];
        }

        throw new \DomainException("No value for key '{$key}'.");
    }

    /**
     *
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this->values);
    }

    /**
     *
     *
     * @return {string:mixed}
     */
    public function getAll()
    {
        return $this->values;
    }
}
