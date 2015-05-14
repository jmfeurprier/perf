<?php

namespace perf\Xml;

/**
 *
 *
 */
class Document extends Node
{

    /**
     * Constructor.
     *
     * @param {string:Node} $nodes
     * @return void
     */
    public function __construct(array $nodes)
    {
        parent::__construct($nodes);
    }
}
