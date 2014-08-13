<?php

namespace perf\Form\Field;

/**
 *
 *
 * @package perf
 */
class Select extends Field
{

    /**
     *
     *
     * @var Select\Option[]
     */
    private $options = array();

    /**
     *
     *
     * @param Select\Option[] $options
     * @return Select Fluent return.
     */
    public function setOptions(array $options)
    {
        $this->options = array();

        foreach ($options as $option) {
            $this->addOption($option);
        }

        return $this;
    }

    /**
     *
     *
     * @param Select\Option $option
     * @return Select Fluent return.
     */
    public function addOption(Select\Option $option)
    {
        $this->options[] = $option;

        return $this;
    }

    /**
     *
     *
     * @return Select\Option[]
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     *
     *
     * @param string $value
     * @return Select Fluent return.
     */
    public function setSubmittedValue($value)
    {
        $selected = false;

        foreach ($this->getOptions() as $option) {
            // If many select options share the same value, select only the first matched one.
            if (($option->getValue() === $value) && !$selected) {
                $option->select();
                $selected = true;
            } else {
                $option->deselect();
            }
        }

        return parent::setSubmittedValue($value);
    }
}
