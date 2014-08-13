<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing an e-mail address.
 *
 * @package perf
 */
class Email extends String
{

    const REGEX = '/^[a-z\'0-9]+([._-][a-z\'0-9]+)*@([a-z0-9]+([._-][a-z0-9]+))+$/Di';

    /**
     * Validates specified e-mail address string.
     *
     * @param string $string String to validate.
     * @return bool true if specified e-mail address string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (1 === preg_match(self::REGEX, $string));
    }
}
