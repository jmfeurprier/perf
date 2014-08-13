<?php

namespace perf\String;

/**
 * This class allows to handle and validate strings representing a IPv4 address.
 *
 * @package perf
 */
class IpV4 extends String
{

    /**
     * Validates specified IPv4 string.
     *
     * @param string $string String to validate.
     * @return bool true if specified IPv4 string is valid, false otherwise.
     */
    public static function validate($string)
    {
        return (long2ip(ip2long($string)) === $string);
    }
}
