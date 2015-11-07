<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\Ivona as Options;
use AudioManager\Adapter\Ivona\Payload;

/**
 * Adapter for Ivona TTS
 * @package AudioManager\Adapter
 */
class Ivona extends AbstractAdapter implements AdapterInterface
{

    protected $authenticate;

    /**
     * Get options object
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Init options
     * @return Options
     */
    protected function initOptions()
    {
        return new Options;
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
}
