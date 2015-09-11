<?php

namespace AudioManager\Adapter\Ivona;

/**
 * Simple authenticator with secret key and success key for Ivona adapter
 * @package AudioManager\Adapter\Ivona
 */
class Authenticate
{

    protected $secretKey;
    protected $accessKey;
    protected $currentTime;
    protected $currentDate;
    protected $payload;

    public function __construct()
    {
        $this->currentTime = gmdate('Ymd\THis\Z', time());
        $this->currentDate = substr($this->currentTime, 0, 8);
    }

    /**
     * Set secret key
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey($secretKey)
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
    public function setAccessKey($accessKey)
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
     * Get authorization headers
     * @return array
     */
    public function getHeader()
    {
        return [
            'X-Amz-Date: ' . $this->currentTime,
            'Authorization: AWS4-HMAC-SHA256 Credential='
                . $this->getCredential()
                . ',SignedHeaders=host,Signature='
                . $this->getSignature()
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
     * @param      $service
     * @param null $payload
     * @return string
     */
    private function getCanonicalRequest($service, $payload = null)
    {
        $canonicalizedGetRequest =
            "POST" .
            "\n/$service" .
            "\n" .
            "\nhost:tts.eu-west-1.ivonacloud.com" .
            "\n" .
            "\nhost" .
            "\n" . hash("sha256", $payload);
        return $canonicalizedGetRequest;
    }

    private function getStringToSign($canonicalizedGetRequest)
    {
        $stringToSign = "AWS4-HMAC-SHA256" .
            "\n$this->currentTime" .
            "\n$this->currentDate/eu-west-1/tts/aws4_request" .
            "\n" . hash("sha256", $canonicalizedGetRequest);

        return $stringToSign;
    }

    private function getSignature($stringToSign)
    {
        $dateKey = hash_hmac('sha256', $this->currentDate, "AWS4" . $this->getSecretKey(), true);
        $dateRegionKey = hash_hmac('sha256', "eu-west-1", $dateKey, true);
        $dateRegionServiceKey = hash_hmac('sha256', "tts", $dateRegionKey, true);
        $signingKey = hash_hmac('sha256', "aws4_request", $dateRegionServiceKey, true);
        $signature = hash_hmac('sha256', $stringToSign, $signingKey);

        return $signature;
    }
}
