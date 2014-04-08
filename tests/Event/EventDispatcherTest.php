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
        $this->eventDispatcher = new EventDispatcher(null);
    }

    public function testRegister()
    {
        $eventListener = new EventListener(null);

        $this->assertEquals(true, $this->eventDispatcher->register('event.test', $eventListener));

        $listenersReflection = new ReflectionProperty('Event\EventDispatcher', 'listeners');
        $listenersReflection->setAccessible(true);
        $listeners = $listenersReflection->getValue($this->eventDispatcher);
        $this->assertCount(1, $listeners);
        $this->assertCount(1, $listeners['event.test']);
        $this->assertContains($eventListener, $listeners['event.test']);
    }

    public function testDispatch()
    {
        $eventListener = $this->getMockBuilder('Event\EventListener')->disableOriginalConstructor()->getMock();

        $eventListener->expects($this->once())->method('onEvent')->with(
            'event.test',
            array(
                'test' => 'test'
            )
        )->will($this->returnValue(true));

        $this->eventDispatcher->register('event.test', $eventListener);
        $this->assertTrue($this->eventDispatcher->dispatch('event.test', array('test' => 'test')));
    }

    public function testDispatchFail()
    {
        $eventListener = $this->getMockBuilder('Event\EventListener')->disableOriginalConstructor()->getMock();

        $eventListener->expects($this->once())->method('onEvent')->with(
            'event.test',
            array(
                'test' => 'test'
            )
        )->will($this->returnValue(false));

        $this->eventDispatcher->register('event.test', $eventListener);
        $this->assertFalse($this->eventDispatcher->dispatch('event.test', array('test' => 'test')));
    }
}
