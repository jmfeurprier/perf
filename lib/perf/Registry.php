<?php

namespace perf;

/**
 * This class allows to store values.
 *
 * @package perf
 */
class Registry implements ArrayAccess
{

    /**
     * Associative array matching vars with values.
     *
     * @var {string:mixed}
     */
    private $values = array();

    /**
     *
     *
     * @return {string:mixed}
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     *
     *
     * @param string $var Offset to assign the value to.
     * @param mixed $value Value to set.
     * @return void
     */
    public function __set($var, $value)
    {
        $this->values[$var] = $value;
    }

    /**
     *
     *
     * @param string $var Offset of the value to retrieve.
     * @return mixed Value at provided var.
     * @throws \DomainException
     */
    public function &__get($var)
    {
        if (array_key_exists($var, $this->values)) {
            return $this->values[$var];
        }

        throw new \DomainException();
    }

    /**
     * Checks whether or not a registry variable is set.
     *
     * @param string $var Offset to check.
     * @return bool true if a value was set at provided var.
     */
    public function __isset($var)
    {
        return isset($this->values[$var]);
    }

    /**
     * Unsets a registry variable.
     *
     * @param string $var Offset to unset.
     * @return void
     */
    public function __unset($var)
    {
        unset($this->values[$var]);
    }

    /**
     *
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->values);
    }

    /**
     *
     *
     * @param mixed $offset
     * @return mixed
     * @throws \DomainException
     */
    public function offsetGet($offset)
    {
        if (array_key_exists($offset, $this->values)) {
            return $this->values[$offset];
        }

        throw new \DomainException();
    }

    /**
     *
     *
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->values[$offset] = $value;
    }

    /**
     *
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->values[$offset]);
    }
}
