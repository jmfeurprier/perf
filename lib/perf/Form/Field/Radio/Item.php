<?php

namespace perf\Form\Field\Radio;

/**
 *
 *
 * @package perf
 */
class Item
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
    private $checked = false;

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
     * @return Item Fluent return.
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
     * @param bool $checked
     * @return Item Fluent return.
     */
    public function check($checked = true)
    {
        $this->checked = (bool) $checked;

        return $this;
    }

    /**
     *
     *
     * @return Item Fluent return.
     */
    public function uncheck()
    {
        return $this->check(false);
    }

    /**
     *
     *
     * @return bool
     */
    public function checked()
    {
        return $this->checked;
    }
}
