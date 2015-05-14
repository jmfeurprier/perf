<?php

namespace perf\Form\Filtering;

/**
 *
 *
 * @package perf
 */
class UppercaseFilter implements Filter
{

    const ENCODING_DEFAULT = 'UTF-8';

    /**
     *
     *
     * @var string
     */
    private $encoding;

    /**
     * Constructor.
     *
     * @param string $encoding
     * @return void
     */
    public function __construct($encoding = self::ENCODING_DEFAULT)
    {
        $this->encoding = $encoding;
    }

    /**
     *
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value)
    {
        return mb_strtoupper($value, $this->encoding);
    }
}
