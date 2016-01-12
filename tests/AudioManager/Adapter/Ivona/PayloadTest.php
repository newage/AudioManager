<?php

namespace AudioManager\Adapter\Ivona;

use AudioManager\Exception\RuntimeException;
use AudioManager\Adapter\Options\Ivona as Options;

class PayloadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Payload
     */
    protected $payload;

    public function setUp()
    {
        $this->payload = new Payload();
    }

    /**
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona\Payload');
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
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona\Payload');
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }

    public function testOptions()
    {
        $options = new Options();
        $this->payload->setOptions($options);
        $this->assertTrue($this->payload->getOptions() instanceof Options);
    }

    public function testQueryText()
    {
        $queryText = 'queryText';
        $this->payload->setQueryText($queryText);

        $this->assertEquals($queryText, $this->payload->getQueryText());
    }
    
    /**
     * @expectedException RuntimeException
     */
    public function testServiceException()
    {
        $method = self::getMethod('checkServiceType');
        $method->invoke($this->payload, 'anyService');
    }

    public function testServiceType()
    {
        $method = self::getMethod('checkServiceType');
        $this->assertEquals(
            Payload::SERVICE_TYPE_LIST,
            $method->invoke($this->payload, Payload::SERVICE_TYPE_LIST)
        );
        $this->assertEquals(
            Payload::SERVICE_TYPE_SPEECH,
            $method->invoke($this->payload, Payload::SERVICE_TYPE_SPEECH)
        );
    }

    public function testHeaders()
    {
        $authenticate = $this->getMockBuilder('AudioManager\Adapter\Ivona\Authenticate')
            ->disableOriginalConstructor()
            ->setMethods(['getHeader', 'setPostData'])
            ->getMock();
        $authenticate
            ->method('setPostData')
            ->with($this->anything())
            ->will($this->returnSelf());
        $authenticate
            ->method('getHeader')
            ->with($this->stringContains(Payload::SERVICE_TYPE_SPEECH))
            ->will($this->returnValue([
                'X-Amz-Date:',
                'Authorization:'
            ]));

        $options = $this->getMockBuilder('AudioManager\Adapter\Ivona\Options')
            ->disableOriginalConstructor()
            ->setMethods(['getAuthenticate', 'getPostData', 'getUserAgent'])
            ->getMock();
        $options
            ->method('getAuthenticate')
            ->will($this->returnValue($authenticate));
        $options
            ->method('getPostData')
            ->will($this->returnValue(['data' => true]));
        $options
            ->method('getUserAgent')
            ->will($this->returnValue(Options::DEFAULT_USERAGENT));

        $expectedArray = [
            "Content-Type: application/json",
            "Host: tts.eu-west-1.ivonacloud.com",
            "User-Agent: TestClient 1.0",
            "X-Amz-Date:",
            "Authorization:"
        ];

        $this->payload->setOptions($options);
        $headers = $this->payload->getHeaders(Payload::SERVICE_TYPE_SPEECH);
        $this->assertEquals($expectedArray, $headers);
    }

    public function testGetServiceUrl()
    {
        $expectedUrl = 'https://tts.eu-west-1.ivonacloud.com/CreateSpeech';
        $resultUrl = $this->payload->getServiceUrl();
        $this->assertEquals($expectedUrl, $resultUrl);
    }
}
