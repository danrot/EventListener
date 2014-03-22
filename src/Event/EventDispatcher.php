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
} 
