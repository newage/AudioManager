<?php

namespace Tests\AudioManager\Adapter\Ivona;

use AudioManager\Adapter\Ivona\Authenticate;
use AudioManager\Exception\RuntimeException;

class AuthenticateTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Authenticate
     */
    protected $authenticate;
    protected $secretKey = 'secret';
    protected $accessKey = 'access';

    public function setUp()
    {
        $this->authenticate = new Authenticate($this->secretKey, $this->accessKey);
    }

    /**
     * @param $name
     * @return \ReflectionMethod
     */
    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona\Authenticate');
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
        $class = new \ReflectionClass('AudioManager\Adapter\Ivona\Authenticate');
        $property = $class->getProperty($name);
        $property->setAccessible(true);
        return $property;
    }

    public function testConstructor()
    {
        $this->assertEquals($this->secretKey, $this->authenticate->getSecretKey());
        $this->assertEquals($this->accessKey, $this->authenticate->getAccessKey());
    }

    public function testPostData()
    {
        $postData = ['data' => true];
        $this->authenticate->setPostData($postData);
        $this->assertEquals($postData, $this->authenticate->getPostData());
    }

    public function testCredential()
    {
        $credential = self::getMethod('getCredential')->invoke($this->authenticate);
        $credentialString = sprintf(
            '%s/%s/eu-west-1/tts/aws4_request',
            $this->authenticate->getAccessKey(),
            self::getProperty('currentDate')->getValue($this->authenticate)
        );

        $this->assertEquals($credential, $credentialString);
    }

    public function testServiceType()
    {
        $method = self::getMethod('checkServiceType');
        $this->assertEquals(
            Authenticate::SERVICE_TYPE_LIST,
            $method->invoke($this->authenticate, Authenticate::SERVICE_TYPE_LIST)
        );
        $this->assertEquals(
            Authenticate::SERVICE_TYPE_SPEECH,
            $method->invoke($this->authenticate, Authenticate::SERVICE_TYPE_SPEECH)
        );
    }

    /**
     * @expectedException RuntimeException
     */
    public function testServiceException()
    {
        $method = self::getMethod('checkServiceType');
        $method->invoke($this->authenticate, 'anyService');
    }

    public function testCreateSignature()
    {
        $currentTime = self::getProperty('currentTime');
        $currentData = self::getProperty('currentDate');

        $this->authenticate->setPostData(['data' => true]);
        $encodedData = json_encode($this->authenticate->getPostData());

        $canonical =
            "POST\n/" . Authenticate::SERVICE_TYPE_SPEECH .
            "\n\nhost:tts.eu-west-1.ivonacloud.com\n" .
            "\nhost\n" . hash("sha256", $encodedData);

        $stringToSign = "AWS4-HMAC-SHA256" .
            "\n" . $currentTime->getValue($this->authenticate) .
            "\n" . $currentData->getValue($this->authenticate) . "/eu-west-1/tts/aws4_request" .
            "\n" . hash("sha256", $canonical);

        $dateKey = hash_hmac(
            'sha256',
            $currentData->getValue($this->authenticate),
            "AWS4" . $this->authenticate->getSecretKey(),
            true
        );
        $dateRegionKey = hash_hmac('sha256', "eu-west-1", $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', "tts", $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', "aws4_request", $dateRegionServiceKey, true);
        $expectSignature = hash_hmac('sha256', $stringToSign, $signingKey);

        $method = self::getMethod('createSignature');
        $resultSignature = $method->invoke($this->authenticate, Authenticate::SERVICE_TYPE_SPEECH);

        $this->assertEquals($expectSignature, $resultSignature);
    }

}
