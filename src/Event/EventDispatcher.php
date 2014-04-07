<?php
namespace Event;

class EventDispatcher
{
    private $listeners;

    public function register($event, $listener)
    {
        $this->listeners[$event][] = $listener;
        return true;
    }

    public function dispatch($event, $data)
    {
        foreach ($this->listeners as $type => $listeners) {
            if ($event == $type) {
                foreach ($listeners as $listener) {
                    /** @var $listener EventListener */
                    $listener->onEvent($event, $data);
                }
            }
        }
    }
} 
