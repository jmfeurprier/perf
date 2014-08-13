<?php

namespace perf;

/**
 * This is an interface for the "observer" design pattern.
 *
 * @package perf
 */
interface Observer
{

    /**
     * Warns current instance about specified subject being updated.
     *
     * @param Subject $subject Object which was updated.
     * @return void
     */
    public function update(Subject $subject);
}
