<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a MD5 hash.
 *
 * @package perf
 */
class Md5Hash extends String
{

    const REGEX = '/^[0-9a-fA-F]{32}$/D';

    /**
     * Validates specified MD5 hash string.
     *
     * @param string $string String to validate.
     * @return bool true if specified MD5 hash string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
