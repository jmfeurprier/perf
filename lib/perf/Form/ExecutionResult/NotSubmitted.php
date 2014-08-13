<?php

namespace perf\Form\ExecutionResult;

use \perf\Form\ExecutionResult;

/**
 *
 *
 * @package perf
 */
class NotSubmitted implements ExecutionResult
{

    /**
     *
     *
     * @var {string:mixed}
     */
    private $values;

    /**
     * Constructor
     *
     * @param {string:mixed} $values
     * @return void
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     *
     *
     * @return bool
     */
    public function submitted()
    {
        return false;
    }

    /**
     *
     *
     * @return bool
     */
    public function valid()
    {
        throw new \RuntimeException();
    }

    /**
     *
     *
     * @return Error[]
     */
    public function getErrors()
    {
        return array();
    }

    /**
     *
     *
     * @return {string:mixed}
     */
    public function getValues()
    {
        return $this->values;
    }
}
