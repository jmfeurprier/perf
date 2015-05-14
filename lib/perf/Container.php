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
     * @var KeyValueCollection
     */
    private $closures;

    /**
     *
     *
     * @var KeyValueCollection
     */
    private $instances;

    /**
     * Constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->closures  = new KeyValueCollection();
        $this->instances = new KeyValueCollection();
    }

    /**
     *
     *
     * @param string $key
     * @param \Closure $closure
     * @return Container Fluent return.
     */
    public function prepare($key, \Closure $closure)
    {
        $this->instances->remove($key);
        $this->closures->set($key, $closure);

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
        if ($this->instances->has($key)) {
            return $this->instances->get($key);
        }

        if ($this->closures->has($key)) {
            $closure = $this->closures->get($key);

            $this->set($key, $closure());

            return $this->instances->get($key);
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

        $this->closures->remove($key);
        $this->instances->set($key, $instance);

        return $this;
    }
}
