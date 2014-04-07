<?php
use Event\EventDispatcher;
use Event\EventListener;

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

    public function testDispatch()
    {
        $eventListener1 = $this->getMockBuilder('Event\EventListener')->getMock();

        $eventListener1->expects($this->once())->method('onEvent')->with(
            'event.test',
            array(
                'test' => 'test'
            )
        );

        $this->eventDispatcher->register('event.test', $eventListener1);

        $this->eventDispatcher->dispatch('event.test', array('test' => 'test'));
    }
}
