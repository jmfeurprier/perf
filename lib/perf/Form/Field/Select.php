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
     * @param mixed $value
     * @return Field Fluent return.
     */
    public function setInitialValue($value)
    {
        if (!$this->isSubmitted()) {
            $this->selectOptionByValue($value);
        }

        return parent::setInitialValue($value);
    }

    /**
     *
     *
     * @param string $value
     * @return Field Fluent return.
     */
    public function setSubmittedValue($value)
    {
        $this->selectOptionByValue($value);

        return parent::setSubmittedValue($value);
    }

    /**
     *
     *
     * @param string $value
     * @return void
     */
    private function selectOptionByValue($value)
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
    }
}
