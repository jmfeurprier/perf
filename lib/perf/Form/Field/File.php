<?php

namespace perf\Form\Field;

/**
 *
 *
 * @package perf
 */
class File extends Field
{

    /**
     *
     *
     * @var {string:null|string}
     */
    private $initialValue = array(
        'name'     => null,
        'type'     => null,
        'size'     => null,
        'tmp_name' => null,
        'error'    => null,
    );

    /**
     *
     *
     * @var null|{string:string}
     */
    private $submittedValue = null;

    /**
     *
     *
     * @var bool
     */
    private $submitted = false;

    /**
     *
     *
     * @param mixed $value
     * @return File Fluent return.
     * @throws \InvalidArgumentException
     */
    public function setInitialValue($value)
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException();
        }

        foreach (array_keys($this->initialValue) as $key) {
            if (array_key_exists($key, $value)) {
                $this->initialValue[$key] = $value[$key];
            }
        }

        return $this;
    }

    /**
     *
     *
     * @param string $value
     * @return File Fluent return.
     */
    public function setSubmittedValue($value)
    {
        if (is_array($value)) {
            foreach (array_keys($this->initialValue) as $key) {
                if (array_key_exists($key, $value)) {
                    $this->submittedValue[$key] = $value[$key];
                } else {
                    $this->submittedValue[$key] = null;
                }
            }
        }

        $this->submitted = true;

        return $this;
    }

    /**
     *
     *
     * @return string
     */
    public function getValue()
    {
        if ($this->submitted) {
            return $this->submittedValue;
        }

        return $this->initialValue;
    }

    /**
     *
     *
     * @return File Fluent return.
     */
    public function reset()
    {
        $this->submittedValue = null;
        $this->submitted      = false;

        return $this;
    }
}
