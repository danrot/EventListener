<?php
namespace Event;

class EventListener implements EventListenerInterface
{
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function onEvent($event, $data)
    {
        // TODO: Implement onEvent() method.
        return true;
    }
}
