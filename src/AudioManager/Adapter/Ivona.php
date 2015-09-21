<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Ivona\Options;
use AudioManager\Exception\RuntimeException;

/**
 * Adapter for Ivona TTS
 * @package AudioManager\Adapter
 */
class Ivona implements AdapterInterface
{

    protected $authenticate;
    protected $headers = [];
    protected $options;

    public $serviceUrl = "https://tts.eu-west-1.ivonacloud.com";
    public $outputFormatCodec = 'MP3';
    public $outputFormatSampleRate = '22050';
    public $parametersRate = 'slow';
    public $serviceHeaders = [];

    /**
     * Constructor
     * @param Options|array $options
     */
    public function __construct($options)
    {
        $this->setOptions($options);
    }

    /**
     * Read audio from Ivona service
     * @param string $text
     * @return mixed
     */
    public function read($text)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->serviceUrl . '/CreateSpeech');
        curl_setopt($curl, CURLOPT_POST, true);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $this->getServiceHeaders());
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $this->setHeaders(curl_getinfo($curl));
        curl_close($curl);

        return $response;
    }

    public function setServiceHeaders()
    {
        $this->headers[] = 	'X-Amz-Date: '.$this->xAmzDate;
        $this->headers[] = 	'Authorization: ' . 'AWS4-HMAC-SHA256 Credential='.$this->xAmzCredential.',SignedHeaders=host,Signature='.$signature;
        $this->headers[] = 	'Content-Type: '. 'application/json';
        $this->headers[] = 	'Host: ' . 'tts.eu-west-1.ivonacloud.com';
        $this->headers[] = 	'User-Agent: ' . 'TestClient 1.0';
        $this->headers[] = 	'Expect:';
    }

    public function getServiceHeaders()
    {
        $this->setServiceHeaders();
        return $this->headers;
    }
    
    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set options
     * @param Options $options
     * @return $this
     * @throw RuntimeException
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        if (null === $this->options) {
            throw new RuntimeException('Need set up options');
        }
        return $this->options;
    }
}
