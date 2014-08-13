<?php

namespace perf\Form\Field;

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
        $this->submittedValue = $value;
        $this->submitted      = true;

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
