<?php

namespace perf\Caching;

/**
 *
 *
 * @package perf
 */
class FetchHit extends FetchResult
{

    /**
     *
     *
     * @var mixed
     */
    private $data;

    /**
     * Constructor.
     *
     * @param mixed $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     *
     *
     * @return bool
     */
    public function hit()
    {
        return true;
    }

    /**
     *
     *
     * @return mixed
     */
    public function data()
    {
        return $this->data;
    }
}
