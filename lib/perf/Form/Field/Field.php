<?php

namespace perf\Form\Field;

use perf\Form\Filtering\Filter;

/**
 *
 *
 * @package perf
 */
abstract class Field
{

    /**
     *
     *
     * @var string
     */
    private $name;

    /**
     *
     *
     * @var mixed
     */
    private $initialValue = '';

    /**
     *
     *
     * @var null|mixed
     */
    private $submittedValue = null;

    /**
     *
     *
     * @var bool
     */
    private $submitted = false;

    /**
     *
     *
     * @var Filter[]
     */
    private $filters = array();

    /**
     * Constructor.
     * To be called by subclasses.
     *
     * @param string $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = (string) $name;
    }

    /**
     *
     *
     * @param mixed $value
     * @return Field Fluent return.
     */
    public function setInitialValue($value)
    {
        $this->initialValue = $value;

        return $this;
    }

    /**
     *
     *
     * @param mixed $value
     * @return Field Fluent return.
     */
    public function setSubmittedValue($value)
    {
        foreach ($this->filters as $filter) {
            $value = $filter->apply($value);
        }

        $this->submittedValue = $value;
        $this->submitted      = true;

        return $this;
    }

    /**
     *
     *
     * @param Filter $filter
     * @return Field Fluent return.
     */
    public function addFilter(Filter $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     *
     * @return mixed
     */
    public function getValue()
    {
        if ($this->submitted) {
            return $this->submittedValue;
        }

        return $this->initialValue;
    }

    /**
     *
     *
     * @return Field Fluent return.
     */
    public function reset()
    {
        $this->submittedValue = null;
        $this->submitted      = false;

        return $this;
    }
}
