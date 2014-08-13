<?php

namespace perf\Caching;

/**
 *
 *
 * @package perf
 */
abstract class FetchResult
{

    /**
     *
     *
     * @return bool
     */
    public function miss()
    {
        return !$this->hit();
    }

    /**
     *
     *
     * @return bool
     */
    abstract public function hit();

    /**
     *
     *
     * @return mixed
     */
    abstract public function data();
}
