<?php

namespace perf\Form\Field;

/**
 *
 *
 * @package perf
 */
class Radio extends Field
{

    /**
     *
     *
     * @var Radio\Item[]
     */
    private $items = array();

    /**
     *
     *
     * @param Radio\Item[] $items
     * @return Radio Fluent return.
     */
    public function setItems(array $items)
    {
        $this->items = array();

        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     *
     *
     * @param Radio\Item $item
     * @return Radio Fluent return.
     */
    public function addItem(Radio\Item $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     *
     *
     * @return Radio\Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     *
     *
     * @param string $value
     * @return Radio Fluent return.
     */
    public function setSubmittedValue($value)
    {
        $checked = false;

        foreach ($this->getItems() as $item) {
            // If many radio items share the same value, check only the first matched one.
            if (($item->getValue() === $value) && !$checked) {
                $item->check();
                $checked = true;
            } else {
                $item->uncheck();
            }
        }

        $this->submittedValue = (string) $value;
        $this->submitted      = true;

        return parent::setSubmittedValue($value);
    }
}
