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
     * @var Errors
     */
    private $errors;

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

        $errors = $this->getErrors();

        if (count($errors) > 0) {
            $this->onInvalid($values);

            return new ExecutionResult\Invalid($errors, $values);
        }

        $this->onValid($values);

        return new ExecutionResult\Valid($values);
    }

    /**
     *
     *
     * @return Form Fluent return.
     */
    private function clearErrors()
    {
        $this->errors = new Errors();

        return $this;
    }

    /**
     *
     * Default implementation, to be overridden.
     *
     * @param unknown_type $submittedValues
     * @return bool
     */
    protected function submittable(array $submittedValues)
    {
        return true;
    }

    /**
     *
     *
     * @param unknown_type $values
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

        $this->getErrors()->add($error);

        return $error;
    }

    /**
     *
     *
     * @return int
     */
    protected function getErrorCount()
    {
        return count($this->getErrors());
    }

    /**
     *
     * Default implementation.
     *
     * @param unknown_type $values
     * @return void
     */
    protected function onValid(array $values)
    {
    }

    /**
     *
     * Default implementation.
     *
     * @param unknown_type $values
     * @return void
     */
    protected function onInvalid(array $values)
    {
    }

    /**
     *
     *
     * @return Errors
     */
    private function getErrors()
    {
        if (!isset($this->errors)) {
            $this->errors = new Errors();
        }

        return $this->errors;
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
