<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Ivona\Options;
use AudioManager\Adapter\Ivona\Payload;

/**
 * Adapter for Ivona TTS
 * @package AudioManager\Adapter
 */
class Ivona implements AdapterInterface
{

    protected $authenticate;
    protected $headers = [];
    protected $options;

    /**
     * Constructor
     * @param Options $options
     */
    public function __construct(Options $options)
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
        $payload = new Payload($this->getOptions(), $text);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $payload->getServiceUrl());
        curl_setopt($curl, CURLOPT_POST, true);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload->getPayload());
        curl_setopt($curl, CURLOPT_HTTPHEADER, $payload->getHeaders());
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $this->setHeaders(curl_getinfo($curl));
        curl_close($curl);

        return $response;
    }

    /**
     * Get available list voices
     */
    public function listVoices()
    {

    }

    /**
     * Set headers after curl
     * @param array $headers
     */
    protected function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * Get headers after curl
     * @return array
     */
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
        return $this->options;
    }
}
