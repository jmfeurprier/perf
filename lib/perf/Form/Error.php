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
     * @throws \InvalidArgumentException
     */
    public function __construct($id)
    {
        if (!is_string($id) || ('' === $id)) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
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
     * @throws \InvalidArgumentException
     */
    public function setMessage($message)
    {
        if ((null !== $message) && !is_string($message)) {
            throw new \InvalidArgumentException();
        }

        $this->message = $message;

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
     * @throws \InvalidArgumentException
     */
    public function setFieldName($name)
    {
        if ((null !== $name) && !is_string($name)) {
            throw new \InvalidArgumentException();
        }

        $this->fieldName = $name;

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
