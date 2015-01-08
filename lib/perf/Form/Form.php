<?php

namespace perf\Form;

use \perf\Form\Field\Field;
use \perf\Form\Field\Fields;

/**
 *
 *
 * @package perf
 */
abstract class Form
{

    /**
     *
     *
     * @var Fields
     */
    private $fields;

    /**
     *
     *
     * @var Error[]
     */
    private $errors = array();

    /**
     *
     *
     * @param Field $field
     * @return Field
     */
    protected function addField(Field $field)
    {
        $this->getFields()->add($field);

        return $field;
    }

    /**
     *
     *
     * @param array $submittedValues
     * @return ExecutionResult
     */
    public function execute(array $submittedValues)
    {
        $this->clearErrors();

        if (!$this->submittable($submittedValues)) {
            return new ExecutionResult\NotSubmitted($this->getValues());
        }

        $values = $this->getFields()->setSubmittedValues($submittedValues)->getValues();

        $this->validate($values);

        if (count($this->errors) > 0) {
            $this->onInvalid($values);

            return new ExecutionResult\Invalid($this->errors, $values);
        }

        $this->onValid($values);

        return new ExecutionResult\Valid($values);
    }

    /**
     *
     *
     * @return void
     */
    private function clearErrors()
    {
        $this->errors = array();
    }

    /**
     *
     * Default implementation, to be overridden.
     *
     * @param {string:mixed} $submittedValues
     * @return bool
     */
    protected function submittable(array $submittedValues)
    {
        return true;
    }

    /**
     *
     *
     * @param {string:mixed} $values
     * @return void
     */
    abstract protected function validate(array $values);

    /**
     *
     *
     * @return Fields
     */
    public function getFields()
    {
        if (!isset($this->fields)) {
            $this->fields = new Fields();
        }

        return $this->fields;
    }

    /**
     *
     *
     * @param string $id
     * @return Error
     */
    protected function addError($id)
    {
        $error = new Error($id);

        $this->errors[] = $error;

        return $error;
    }

    /**
     *
     *
     * @return int
     */
    protected function getErrorCount()
    {
        return count($this->errors);
    }

    /**
     *
     * Default implementation.
     *
     * @param {string:mixed} $values
     * @return void
     */
    protected function onValid(array $values)
    {
    }

    /**
     *
     * Default implementation.
     *
     * @param {string:mixed} $values
     * @return void
     */
    protected function onInvalid(array $values)
    {
    }

    /**
     *
     *
     * @return {string:mixed}
     */
    public function getValues()
    {
        return $this->getFields()->getValues();
    }

    /**
     *
     *
     * @return Form Fluent return.
     */
    public function resetFields()
    {
        $this->getFields()->reset();

        return $this;
    }
}
