<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a decimal number.
 *
 * @package perf
 */
class DecimalNumber extends String
{

    const REGEX = '/^[0-9]+$/D';

    /**
     * Validates specified decimal number string.
     *
     * @param string $string String to validate.
     * @return bool true if specified decimal number string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
