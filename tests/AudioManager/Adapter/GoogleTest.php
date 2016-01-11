<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Google;
use AudioManager\Adapter\Options\Google as Options;
use AudioManager\Request\CurlRequest;

class GoogleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Google
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new Google();
    }

    /**
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('AudioManager\Adapter\Google');
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
        $class = new \ReflectionClass('AudioManager\Adapter\Google');
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

    public function testCreateUrlWithoutEncoding()
    {
        $this->adapter->getOptions()->setLanguage('en');

        $method = self::getMethod('createUrl');
        $resultUrl = $method->invoke($this->adapter, 'query');
        $expectedUrl = 'http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=query';

        $this->assertEquals($expectedUrl, $resultUrl);
    }

    public function testCreateUrlWithEncoding()
    {
        $this->adapter->getOptions()->setLanguage('en');
        $this->adapter->getOptions()->setEncoding('WIN-1251');

        $method = self::getMethod('createUrl');
        $resultUrl = $method->invoke($this->adapter, 'query');
        $expectedUrl = 'http://translate.google.com/translate_tts?ie=WIN-1251&tl=en&q=query';

        $this->assertEquals($expectedUrl, $resultUrl);
    }

    public function testRead()
    {
        $content = 'JSON';

        $request = $this->getMockBuilder('AudioManager\Request\CurlRequest')
            ->setMethods(['execute'])
            ->getMock();
        $request->method('execute')
            ->will($this->returnValue($content));

        $this->adapter->getOptions()->setLanguage('en');
        $this->adapter->setHandle($request);
        $result = $this->adapter->read('text');

        $this->assertEquals($content, $result);
    }
}
