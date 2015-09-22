<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Google;
use AudioManager\Adapter\Google\Options;

class GoogleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Google
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = new Google(new Options());
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
        $options = $this->getMockBuilder('AudioManager\Adapter\Google\Options')
            ->disableOriginalConstructor()
            ->setMethods(['hasEncoding', 'getLanguage'])
            ->getMock();
        $options
            ->method('hasEncoding')
            ->will($this->returnValue(false));
        $options
            ->method('getLanguage')
            ->will($this->returnValue('en'));

        $this->adapter->setOptions($options);
        $method = self::getMethod('createUrl');
        $resultUrl = $method->invoke($this->adapter, 'query');
        $expectedUrl = 'http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=query';

        $this->assertEquals($expectedUrl, $resultUrl);
    }

    public function testCreateUrlWithEncoding()
    {
        $options = $this->getMockBuilder('AudioManager\Adapter\Google\Options')
            ->disableOriginalConstructor()
            ->setMethods(['hasEncoding', 'getEncoding', 'getLanguage'])
            ->getMock();
        $options
            ->method('hasEncoding')
            ->will($this->returnValue(true));
        $options
            ->method('getEncoding')
            ->will($this->returnValue('WIN-1251'));
        $options
            ->method('getLanguage')
            ->will($this->returnValue('en'));

        $this->adapter->setOptions($options);
        $method = self::getMethod('createUrl');
        $resultUrl = $method->invoke($this->adapter, 'query');
        $expectedUrl = 'http://translate.google.com/translate_tts?ie=WIN-1251&tl=en&q=query';

        $this->assertEquals($expectedUrl, $resultUrl);
    }
}
