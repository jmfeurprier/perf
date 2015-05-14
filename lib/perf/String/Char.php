<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a single character ("char").
 *
 */
class Char extends String
{

    /**
     * Validates specified char string.
     *
     * @param string $string String to validate.
     * @return bool true if specified char string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === mb_strlen($string));
    }
}
