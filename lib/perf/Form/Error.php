<?php

namespace perf\Form;

/**
 *
 *
 * @package perf
 */
class Error
{

    /**
     *
     *
     * @var string
     */
    private $id;

    /**
     *
     *
     * @var null|string
     */
    private $message;

    /**
     *
     *
     * @var null|string
     */
    private $fieldName;

    /**
     * Constructor.
     *
     * @param string $id
     * @return void
     */
    public function __construct($id)
    {
        $this->id = (string) $id;
    }

    /**
     *
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     *
     * @param null|string $message
     * @return Error Fluent return.
     */
    public function setMessage($message)
    {
        $this->message = is_null($message)
                       ? null
                       : (string) $message;

        return $this;
    }

    /**
     *
     *
     * @return null|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     *
     * @param null|string $name
     * @return Error Fluent return.
     */
    public function setFieldName($name)
    {
        $this->fieldName = is_null($name)
                         ? null
                         : (string) $name;

        return $this;
    }

    /**
     *
     *
     * @return null|string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }
}
