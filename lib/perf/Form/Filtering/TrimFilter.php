<?php

namespace perf\Form\Filtering;

/**
 *
 *
 * @package perf
 */
class TrimFilter implements Filter
{

    /**
     *
     *
     * @var string[]
     */
    static private $defaultTrimmableCharacters = array(
        " ",
        "\n",
        "\r",
        "\t",
        "\0",
        "\x0b",
    );

    /**
     *
     *
     * @var string
     */
    private $trimmableCharacters;

    /**
     *
     *
     * @param mixed $value
     * @return mixed
     */
    public function __construct(array $trimmableCharacters = self::$defaultTrimmableCharacters)
    {
        $this->trimmableCharacters = join($trimmableCharacters);
    }

    /**
     *
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value)
    {
        return trim($value, $this->trimmableCharacters);
    }
}
