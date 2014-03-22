<?php
use Event\EventDispatcher;
use Event\EventListener;

/**
 * Created by IntelliJ IDEA.
 * User: daniel
 * Date: 3/22/14
 * Time: 8:10 PM
 */

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    public function setUp()
    {
        $this->eventDispatcher = new EventDispatcher();
    }

    public function testRegister()
    {
        $eventListener = new EventListener();

        $this->assertEquals(true, $this->eventDispatcher->register('event.test', $eventListener));
    }
}
