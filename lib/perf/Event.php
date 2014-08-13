<?php

namespace perf;

/**
 *
 *
 * @package perf
 */
class Event
{

    /**
     *
     *
     * @var Subject
     */
    private $subject;

    /**
     *
     *
     * @var mixed
     */
    private $expectedState;

    /**
     *
     *
     * @var callback
     */
    private $callback;

    /**
     *
     *
     * @param Subject $subject
     * @param mixed $expectedState
     * @param callback $callback
     */
    public function __construct(Subject $subject, $expectedState, $callback)
    {
        $this->subject       = $subject;
        $this->expectedState = $expectedState;
        $this->callback      = $callback;
    }

    /**
     *
     *
     * @return Subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     *
     *
     * @return mixed
     */
    public function getExpectedState()
    {
        return $this->expectedState;
    }

    /**
     *
     *
     * @return callback
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     *
     *
     * @return void
     */
    public function trigger()
    {
        call_user_func_array($this->getCallback(), array($this->getSubject()));
    }
}
