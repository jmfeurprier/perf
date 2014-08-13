<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a binary number.
 *
 * @package perf
 */
class BinaryNumber extends String
{

    const REGEX = '/^[01]+$/D';

    /**
     * Validates specified binary number string.
     *
     * @param string $string String to validate.
     * @return bool true if specified binary number string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
