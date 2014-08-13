<?php

namespace perf\Form\Field\Select;

/**
 *
 *
 * @package perf
 */
class Option
{

    /**
     *
     *
     * @var string
     */
    private $value;

    /**
     *
     *
     * @var string
     */
    private $label;

    /**
     *
     *
     * @var bool
     */
    private $selected = false;

    /**
     * Constructor.
     *
     * @param string $value
     * @param string $label
     * @return void
     */
    public function __construct($value, $label = '')
    {
        $this->setValue($value);
        $this->setLabel($label);
    }

    /**
     *
     *
     * @param string $value
     * @return void
     */
    private function setValue($value)
    {
        $this->value = (string) $value;
    }

    /**
     *
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     *
     *
     * @param null|string $label
     * @return Option Fluent return.
     */
    public function setLabel($label)
    {
        $this->label = (string) $label;

        return $this;
    }

    /**
     *
     *
     * @return null|string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     *
     *
     * @param bool $select
     * @return Option Fluent return.
     */
    public function select($select = true)
    {
        $this->selected = (bool) $select;

        return $this;
    }

    /**
     *
     *
     * @return Option Fluent return.
     */
    public function deselect()
    {
        return $this->select(false);
    }

    /**
     *
     *
     * @return bool
     */
    public function selected()
    {
        return $this->selected;
    }
}
