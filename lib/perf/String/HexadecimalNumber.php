<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a hexadecimal number.
 *
 */
class HexadecimalNumber extends String
{

    const REGEX = '/^[0-9a-f]+$/Di';

    /**
     * Validates specified hexadecimal number string.
     *
     * @param string $string String to validate.
     * @return bool true if specified hexadecimal number string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
