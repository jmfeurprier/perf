<?php

namespace perf\String;

/**
 * This abstract class and its children allow to handle and validate strings with a pre-defined format
 *   (like e-mail address, hexadecimal number, etc).
 *
 */
abstract class String
{

    /**
     * String representation of the current instance.
     *
     * @var string
     */
    private $string;

    /**
     * Constructor. Will throw an exception if provided string is not valid.
     *
     * @param string|object $string String to be used as a candidate to build a perf String object.
     * @return void
     * @throws \InvalidArgumentException
     */
    public function __construct($string)
    {
        $this->checkStringType($string);

        $string = (string) $string;

        if (!$this->validate($string)) {
            throw new \InvalidArgumentException('Invalid string format.');
        }

        $this->string = $string;
    }

    /**
     *
     *
     * @param string|object $string
     * @throws \InvalidArgumentException
     */
    protected function checkStringType($string)
    {
        if (is_string($string)) {
            return;
        }

        if (is_object($string)) {
            if (is_callable(array($string, '__toString'))) {
                return;
            }
        }

        throw new \InvalidArgumentException('Invalid string type.');
    }

    /**
     * Returns the string representation of the current instance.
     *
     * @return string
     */
    public function get()
    {
        return $this->string;
    }

    /**
     * PHP magic method allowing to convert the current instance into a string.
     *
     * @return string String representation of the current instance.
     */
    public function __toString()
    {
        return $this->string;
    }

    /**
     * This is where the string format-specific validation has to be done.
     * This method must be overridden in every subclass.
     *
     * @param string $string
     * @return bool true if provided string matches the expected format.
     */
    public static function validate($string)
    {
        throw new \RuntimeException('Not implemented.');
    }
}
