<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a standardized time (HH:MM:SS).
 *
 * @package perf
 */
class Time extends String
{

    const REGEX = '/^([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/D';

    /**
     * Validates specified time string (HH:MM:SS).
     *
     * @param string $string
     * @return bool true if specified time string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
