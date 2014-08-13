<?php

namespace perf\Caching;

/**
 *
 *
 * @package perf
 */
class FetchMiss extends FetchResult
{

    /**
     *
     *
     * @return bool
     */
    public function hit()
    {
        return false;
    }

    /**
     *
     *
     * @return mixed
     */
    public function data()
    {
        throw new \LogicException('Cache miss.');
    }
}
