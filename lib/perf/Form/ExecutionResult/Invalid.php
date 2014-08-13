<?php

namespace perf\Form\ExecutionResult;

use \perf\Form\ExecutionResult;
use \perf\Form\Errors;
use \perf\Form\Error;

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
     * @var Error[]
     */
    private $errors = array();

    /**
     *
     *
     * @var {string:mixed}
     */
    private $values;

    /**
     * Constructor.
     *
     * @param Errors $errors
     * @param {string:mixed} $values
     * @return void
     */
    public function __construct(Errors $errors, array $values)
    {
        foreach ($errors as $error) {
            $this->addError($error);
        }

        $this->values = $values;
    }

    /**
     *
     * @param Error $error
     * @return void
     */
    private function addError(Error $error)
    {
        $this->errors[] = $error;
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
     * @return Error[]
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
