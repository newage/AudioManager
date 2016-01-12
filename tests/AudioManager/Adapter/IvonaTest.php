<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Ivona;
use AudioManager\Adapter\Options\Ivona as Options;

class IvonaTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Ivona
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new Ivona();
    }

    /**
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

    /**
     * @param $name
     * @return \ReflectionProperty
     */
    protected static function getProperty($name)
    {
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona');
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }

    public function testConstructor()
    {
        $this->assertTrue($this->adapter->getOptions() instanceof Options);
    }

    public function testHeaders()
    {
        $headers = ['headers' => true];
        $method = self::getMethod('setHeaders');
        $method->invoke($this->adapter, $headers);

        $this->assertEquals($headers, $this->adapter->getHeaders());
    }

    public function testRead()
    {
        $content = 'JSON';

        $request = $this->getMockBuilder('AudioManager\Request\CurlRequest')
            ->setMethods(['execute'])
            ->getMock();
        $request->method('execute')
            ->will($this->returnValue($content));

        $payload = $this->getMockBuilder('AudioManager\Adapter\Ivona\Payload')
            ->setMethods(['getServiceUrl', 'getPayload', 'getHeaders'])
            ->getMock();
        $payload->method('getServiceUrl')
            ->will($this->returnValue('http://'));
        $payload->method('getPayload')
            ->will($this->returnValue('{"payload":"json"}'));
        $payload->method('getHeaders')
            ->will($this->returnValue([]));

        $this->adapter->setHandle($request);
        $this->adapter->setPayload($payload);
        $result = $this->adapter->read('text');

        $this->assertEquals($content, $result);
    }
}
