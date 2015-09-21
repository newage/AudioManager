<?php

namespace AudioManager\Adapter\Ivona;
use AudioManager\Exception\RuntimeException;

/**
 * Simple authenticator with secret key and success key for Ivona adapter
 * @package AudioManager\Adapter\Ivona
 */
class Authenticate
{

    const SERVICE_TYPE_LIST = 'ListVoices';
    const SERVICE_TYPE_SPEECH = 'CreateSpeech';

    protected $secretKey;
    protected $accessKey;
    protected $currentTime;
    protected $currentDate;
    protected $postData = [];

    /**
     * Constructor
     * @param $secretKey
     * @param $accessKey
     */
    public function __construct($secretKey, $accessKey)
    {
        $this->setSecretKey($secretKey);
        $this->setAccessKey($accessKey);
        $this->currentTime = gmdate('Ymd\THis\Z', time());
        $this->currentDate = substr($this->currentTime, 0, 8);
    }

    /**
     * Set secret key
     * @param string $secretKey
     * @return $this
     */
    protected function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * Get secret key
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Set access key
     * @param string $accessKey
     * @return $this
     */
    protected function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Get access key
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * Get post data
     * @return array
     */
    public function getPostData()
    {
        return $this->postData;
    }

    /**
     * Set post data
     * @param array $postData
     * @return $this
     */
    public function setPostData(array $postData)
    {
        $this->postData = $postData;
        return $this;
    }

    /**
     * Get authorization headers
     * @param string $requestType
     * @return array
     */
    public function getHeader($requestType)
    {
        return [
            'X-Amz-Date: ' . $this->currentTime,
            'Authorization: AWS4-HMAC-SHA256 Credential='
                . $this->getCredential()
                . ',SignedHeaders=host,Signature='
                . $this->createSignature($requestType)
        ];
    }

    /**
     * Create credential for headers
     */
    protected function getCredential()
    {
        return $this->getAccessKey() . "/" . $this->currentDate . "/eu-west-1/tts/aws4_request";
    }

    /**
     * Get canonical
     * @param      $service
     * @param null $payload
     * @return string
     */
    protected function getCanonicalRequest($service, $payload = null)
    {
        $canonical =
            "POST" .
            "\n/$service" .
            "\n" .
            "\nhost:tts.eu-west-1.ivonacloud.com" .
            "\n" .
            "\nhost" .
            "\n" . hash("sha256", $payload);
        return $canonical;
    }

    /**
     * Get string to sign
     * @param $canonical
     * @return string
     */
    protected function getStringToSign($canonical)
    {
        $stringToSign = "AWS4-HMAC-SHA256" .
            "\n$this->currentTime" .
            "\n$this->currentDate/eu-west-1/tts/aws4_request" .
            "\n" . hash("sha256", $canonical);

        return $stringToSign;
    }

    /**
     * Get signature
     * @param string $stringToSign
     * @return string
     */
    protected function getSignature($stringToSign)
    {
        $dateKey = hash_hmac('sha256', $this->currentDate, "AWS4" . $this->getSecretKey(), true);
        $dateRegionKey = hash_hmac('sha256', "eu-west-1", $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', "tts", $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', "aws4_request", $dateRegionServiceKey, true);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);

        return $signature;
    }

    /**
     * Create signature
     * @param $requestType
     * @return string
     */
    protected function createSignature($requestType)
    {
        if (empty($this->getPostData())) {
            throw new RuntimeException('Need setup post data');
        }

        $obj = json_encode($this->getPostData());
        $canonical = $this->getCanonicalRequest($this->checkServiceType($requestType), $obj);
        $stringToSign = $this->getStringToSign($canonical);
        return $this->getSignature($stringToSign);
    }

    /**
     * Check request type
     * @param string $requestType
     * @return string
     */
    protected function checkServiceType($requestType)
    {
        $reflection = new \ReflectionObject($this);
        $constants = $reflection->getConstants();
        if (!in_array($requestType, $constants)) {
            throw new RuntimeException('Request type does not supports');
        }

        return $requestType;
    }
}
