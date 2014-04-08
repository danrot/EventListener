<?php
namespace Event;

class EventDispatcher
{
    private $listeners;

    public function register($event, EventListenerInterface $listener)
    {
        $this->listeners[$event][] = $listener;
        return true;
    }

    public function dispatch($event, $data)
    {
        $success = true;

        foreach ($this->listeners as $type => $listeners) {
            if ($event == $type) {
                foreach ($listeners as $listener) {
                    /** @var $listener EventListener */
                    if (!$listener->onEvent($event, $data)) {
                        $success = false;
                    }
                }
            }
        }

        return $success;
    }
} 
