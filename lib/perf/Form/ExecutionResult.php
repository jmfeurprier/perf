<?php

namespace perf\Form;

/**
 *
 *
 * @package perf
 */
interface ExecutionResult
{

    /**
     *
     *
     * @return bool
     */
    public function submitted();

    /**
     *
     *
     * @return bool
     */
    public function valid();

    /**
     *
     *
     * @return Error[]
     */
    public function getErrors();

    /**
     *
     *
     * @return mixed[]
     */
    public function getValues();
}
