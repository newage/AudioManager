<?php

namespace AudioManager\Adapter\Ivona;

use AudioManager\Adapter\Ivona\Payload;

class PayloadTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Payload
     */
    protected $payload;

    public function setUp()
    {
        $options = new Options(new Authenticate('secret', 'access'));
        $this->payload = new Payload($options);
    }

    public function testOptions()
    {
        $this->assertTrue($this->payload->getOptions() instanceof Options);
    }

    public function testPostData()
    {
        $postData = ['data' => true];
        $this->payload->setPostData($postData);
        $this->assertEquals($postData, $this->payload->getPostData());
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
            ->with($this->stringContains(Authenticate::SERVICE_TYPE_SPEECH))
            ->will($this->returnValue([
                'X-Amz-Date:',
                'Authorization:'
            ]));

        $options = $this->getMockBuilder('AudioManager\Adapter\Ivona\Options')
            ->disableOriginalConstructor()
            ->setMethods(['getAuthenticate', 'getPostData'])
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
        $headers = $this->payload->getHeaders(Authenticate::SERVICE_TYPE_SPEECH);
        $this->assertEquals($expectedArray, $headers);
    }
}
