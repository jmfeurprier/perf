<?php

namespace perf;

/**
 *
 *
 * @package perf
 */
class Container
{

    /**
     *
     *
     * @var {string:Closure}
     */
    private $closures = array();

    /**
     *
     *
     * @var {string:object}
     */
    private $instances = array();

    /**
     *
     *
     * @param string $key
     * @param Closure $closure
     * @return Container Fluent return.
     */
    public function prepare($key, Closure $closure)
    {
        unset($this->instances[$key]);
        $this->closures[$key] = $closure;

        return $this;
    }

    /**
     *
     *
     * @param string $key
     * @return object
     * @throws \DomainException
     */
    public function get($key)
    {
        if (array_key_exists($key, $this->instances)) {
            return $this->instances[$key];
        }

        if (array_key_exists($key, $this->closures)) {
            $closure = $this->closures[$key];

            $this->set($key, $closure());

            return $this->instances[$key];
        }

        throw new \DomainException("Undefined key '{$key}'.");
    }

    /**
     *
     *
     * @param string $key
     * @param object $instance
     * @return Container Fluent return.
     * @throws \InvalidArgumentException
     */
    public function set($key, $instance)
    {
        if (!is_object($instance)) {
            $message = "Invalid argument for key '{$key}': provided instance is not an object.";
            throw new \InvalidArgumentException($message);
        }

        unset($this->closures[$key]);
        $this->instances[$key] = $instance;

        return $this;
    }
}
