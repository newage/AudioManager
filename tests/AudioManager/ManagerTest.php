<?php

namespace AudioManager;

use AudioManager\Adapter\AdapterInterface;
use AudioManager\Adapter\Google;

class ManagerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Manager
     */
    protected $manager;

    public function setUp()
    {
        $this->manager = new Manager(new Google());
    }

    public function testConstructor()
    {
        $this->assertTrue($this->manager->getAdapter() instanceof AdapterInterface);
    }

    public function testRead()
    {
        $expected = 'audio';
        $adapter = $this->getMockBuilder('AudioManager\Adapter\Google')
            ->disableOriginalConstructor()
            ->setMethods(['read'])
            ->getMock();
        $adapter
            ->method('read')
            ->will($this->returnValue($expected));

        $manager = new Manager($adapter);
        $result = $manager->read('audio');

        $this->assertEquals($expected, $result);
    }

    public function testGetHeaders()
    {
        $expected = ['header' => true];
        $adapter = $this->getMockBuilder('AudioManager\Adapter\Google')
            ->disableOriginalConstructor()
            ->setMethods(['getHeaders'])
            ->getMock();
        $adapter
            ->method('getHeaders')
            ->will($this->returnValue($expected));

        $manager = new Manager($adapter);
        $result = $manager->getHeaders();

        $this->assertEquals($expected, $result);
    }
}
