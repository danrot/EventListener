<?php
namespace Event;

interface EventListenerInterface
{
    public function onEvent($event, $data);
} 
