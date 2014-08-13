<?php

namespace perf;

/**
 * This is an interface for the "observer" design pattern.
 *
 * @package perf
 */
interface Subject extends Stated
{

    /**
     * Adds an observer to current instance.
     *
     * @param Observer $observer Object which will wait for current instance to be updated.
     * @return void
     */
    public function attach(Observer $observer);

    /**
     * Removes an observer from current instance.
     *
     * @param Observer $observer Object to remove from observers list.
     * @return void
     */
    public function detach(Observer $observer);

    /**
     * Notifies every attached observer about current instance being updated.
     *
     * @return void
     */
    public function notify();
}
