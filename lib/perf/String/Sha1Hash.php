<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a SHA1 hash.
 *
 * @package perf
 */
class Sha1Hash extends String
{

    const REGEX = '/^[0-9a-fA-F]{40}$/D';

    /**
     * Validates specified SHA1 hash string.
     *
     * @param string $string String to validate.
     * @return bool true if specified SHA1 hash string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
