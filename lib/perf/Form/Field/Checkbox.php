<?php

namespace perf\Form\Field;

/**
 *
 *
 * @package perf
 */
class Checkbox extends Field
{

    /**
     *
     *
     * @var string
     */
    private $checkedValue = '1';

    /**
     *
     *
     * @var string
     */
    private $uncheckedValue = '0';

    /**
     *
     *
     * @var null|string
     */
    private $label;

    /**
     * Constructor.
     *
     * @param string $name
     * @param string $checkedValue
     * @param string $uncheckedValue
     * @return void
     */
    public function __construct($name, $checkedValue = '1', $uncheckedValue = '0')
    {
        parent::__construct($name);

        $this
            ->setCheckedValue($checkedValue)
            ->setUncheckedValue($uncheckedValue)
        ;
    }

    /**
     *
     *
     * @param string $value
     * @return Checkbox
     */
    public function setCheckedValue($value)
    {
        $this->checkedValue = (string) $value;

        return $this;
    }

    /**
     *
     *
     * @param string $value
     * @return Checkbox
     */
    public function setUncheckedValue($value)
    {
        $this->uncheckedValue = (string) $value;

        return $this;
    }

    /**
     *
     *
     * @return bool
     */
    public function unchecked()
    {
        return !$this->checked();
    }

    /**
     *
     *
     * @return bool
     */
    public function checked()
    {
        return ($this->getValue() === $this->getCheckedValue());
    }

    /**
     *
     *
     * @return Checkbox
     */
    public function uncheck()
    {
        return $this->check(false);
    }

    /**
     *
     *
     * @param bool $checked
     * @return Checkbox Fluent return.
     */
    public function check($checked = true)
    {
        if ($checked) {
            $submittedValue = $this->getCheckedValue();
        } else {
            $submittedValue = $this->getUncheckedValue();
        }

        return $this->setSubmittedValue($submittedValue);
    }

    /**
     *
     *
     * @return string
     */
    public function getCheckedValue()
    {
        return $this->checkedValue;
    }

    /**
     *
     *
     * @return string
     */
    public function getUncheckedValue()
    {
        return $this->uncheckedValue;
    }

    /**
     *
     *
     * @param null|string $label
     * @return Checkbox Fluent return.
     */
    public function setLabel($label)
    {
        $this->label = is_null($label)
                     ? null
                     : (string) $label;

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
}
