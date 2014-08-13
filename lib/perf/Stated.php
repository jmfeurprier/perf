<?php

namespace perf;

/**
 * This interface is to be used for objects which have a "state", like for the "observer" design pattern.
 *
 * @package perf
 */
interface Stated
{

    /**
     * Binds a state to current instance.
     *
     * @param mixed $state
     */
    public function setState($state);

    /**
     * Returns the state of the current instance.
     *
     * @return mixed
     */
    public function getState();
}
