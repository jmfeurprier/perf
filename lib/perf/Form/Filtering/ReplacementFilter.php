<?php

namespace perf\Form\Filtering;

/**
 *
 *
 * @package perf
 */
class ReplacementFilter implements Filter
{

    /**
     *
     *
     * @var {string:string}
     */
    private $replacements = array();

    /**
     * Constructor.
     *
     * @param {string:string} $replacements
     * @return void
     */
    public function __construct(array $replacements)
    {
        $this->replacements = $replacements;
    }

    /**
     *
     *
     * @param mixed $value
     * @return mixed
     */
    public function apply($value)
    {
        $search  = array_keys($this->replacements);
        $replace = array_values($this->replacements);

        return str_replace($search, $replace, $value);
    }
}
