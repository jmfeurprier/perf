<?php

namespace perf\Form\ExecutionResult;

use \perf\Form\Error;
use \perf\Form\ErrorCollection;
use \perf\Form\ExecutionResult;

/**
 *
 *
 * @package perf
 */
class Invalid implements ExecutionResult
{

    /**
     *
     *
     * @var ErrorCollection
     */
    private $errors;

    /**
     *
     *
     * @var {string:mixed}
     */
    private $values;

    /**
     * Constructor.
     *
     * @param Error[] $errors
     * @param {string:mixed} $values
     * @return void
     */
    public function __construct(array $errors, array $values)
    {
        $this->errors = new ErrorCollection($errors);
        $this->values = $values;
    }

    /**
     *
     *
     * @return bool
     */
    public function submitted()
    {
        return true;
    }

    /**
     *
     *
     * @return bool
     */
    public function valid()
    {
        return false;
    }

    /**
     *
     *
     * @return ErrorCollection
     */
    public function getErrors()
    {
        return $this->errors;
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
