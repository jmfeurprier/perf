<?php

namespace perf\Form\Filtering;

/**
 *
 *
 * @package perf
 */
interface Filter
{

    /**
     *
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value);
}
