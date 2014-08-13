<?php

namespace perf\Form\Field;

/**
 *
 *
 * @package perf
 */
class Fields implements \IteratorAggregate
{

    /**
     *
     *
     * @var {string:Field}
     */
    private $fields = array();

    /**
     *
     *
     * @return \Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->fields);
    }

    /**
     *
     *
     * @param Field $field
     * @return Fields Fluent return.
     */
    public function add(Field $field)
    {
        $this->fields[$field->getName()] = $field;

        return $this;
    }

    /**
     *
     *
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->fields);
    }

    /**
     *
     *
     * @param string $name
     * @return Field
     * @throws \DomainException
     */
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->fields[$name];
        }

        throw new \DomainException("No form field with name '{$name}'.");
    }

    /**
     *
     *
     * @param string $name
     * @return Fields Fluent return.
     */
    public function remove($name)
    {
        unset($this->fields[$name]);

        return $this;
    }

    /**
     *
     *
     * @return Fields Fluent return.
     */
    public function reset()
    {
        foreach ($this->fields as $field) {
            $field->reset();
        }

        return $this;
    }

    /**
     *
     *
     * @param unknown_type $values
     * @return Fields Fluent return.
     */
    public function setInitialValues(array $values)
    {
        foreach ($this->fields as $field) {
            $fieldName = $field->getName();

            if (array_key_exists($fieldName, $values)) {
                $value = $values[$fieldName];

                $field->setInitialValue($value);
            }
        }

        return $this;
    }

    /**
     *
     *
     * @param unknown_type $values
     * @return Fields Fluent return.
     */
    public function setSubmittedValues(array $values)
    {
        foreach ($this->fields as $field) {
            $fieldName = $field->getName();

            if (array_key_exists($fieldName, $values)) {
                $value = $values[$fieldName];

                $field->setSubmittedValue($value);
            }
        }

        return $this;
    }

    /**
     *
     *
     * @return mixed[]
     */
    public function getValues()
    {
        $values = array();

        foreach ($this->fields as $field) {
            $values[$field->getName()] = $field->getValue();
        }

        return $values;
    }
}
