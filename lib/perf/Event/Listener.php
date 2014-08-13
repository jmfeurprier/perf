<?php

namespace perf\Event;

use \perf\Subject;
use \perf\Event;

/**
 *
 *
 * @package perf
 */
class Listener implements Observer
{

    /**
     *
     *
     * @var Event[]
     */
    private $events = array();

    /**
     *
     *
     * @var array
     */
    private $eventSearchTree = array();

    /**
     *
     *
     * @param Event $event
     * @return Listener fluent return
     */
    public function addEvent(Event $event)
    {
        $subject       = $event->getSubject();
        $subjectHash   = spl_object_hash($subject);
        $expectedState = $event->getExpectedState();
        $eventHash     = spl_object_hash($event);

        $this->eventSearchTree[$subjectHash][$expectedState][$eventHash] = $event;
        $this->events[$eventHash]                                        = $event;

        $subject->attach($this);

        return $this;
    }

    /**
     *
     *
     * @param Event $event
     * @return Listener fluent return
     */
    public function removeEvent(Event $event)
    {
        $subject       = $event->getSubject();
        $subjectHash   = spl_object_hash($subject);
        $expectedState = $event->getExpectedState();
        $eventHash     = spl_object_hash($event);

        $subject->detach($this);

        unset($this->eventSearchTree[$subjectHash][$expectedState][$eventHash]);
        unset($this->events[$eventHash]);

        return $this;
    }

    /**
     *
     *
     * @return Listener fluent return
     */
    public function removeEvents()
    {
        foreach ($this->events as $event) {
            $this->removeEvent($event);
        }

        return $this;
    }

    /**
     *
     *
     * @return Event[]
     */
    public function getEvents()
    {
        return array_values($this->events);
    }

    /**
     *
     *
     * @param Subject $subject
     * @return void
     */
    public function update(Subject $subject)
    {
        $subjectHash = spl_object_hash($subject);
        $state       = $subject->getState();

        if (isset($this->eventSearchTree[$subjectHash][$state])) {
            foreach ($this->eventSearchTree[$subjectHash][$state] as $event) {
                $event->trigger();
            }
        }
    }
}
