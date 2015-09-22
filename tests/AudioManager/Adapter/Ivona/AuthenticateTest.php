<?php

namespace AudioManager\Adapter\Ivona;

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

    /**
     * @expectedException RuntimeException
     */
    public function testCreateSignatureException()
    {
        $method = self::getMethod('createSignature');
        $method->invoke($this->authenticate, Payload::SERVICE_TYPE_SPEECH);
    }
    
    public function testCreateHeader()
    {
        $currentTime = self::getProperty('currentTime');
        $currentData = self::getProperty('currentDate');

        $this->authenticate->setPostData(json_encode(['data' => true]));
        $encodedData = $this->authenticate->getPostData();

        $canonical =
            "POST\n/" . Payload::SERVICE_TYPE_SPEECH .
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
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);

        $credentialMethod = self::getMethod('getCredential');
        $expectHeader = [
            'X-Amz-Date: ' . $currentTime->getValue($this->authenticate),
            'Authorization: AWS4-HMAC-SHA256 Credential='
            . $credentialMethod->invoke($this->authenticate)
            . ',SignedHeaders=host,Signature='
            . $signature
        ];

        $resultHeader = $this->authenticate->getHeader(Payload::SERVICE_TYPE_SPEECH);

        $this->assertEquals($expectHeader, $resultHeader);
    }

}
