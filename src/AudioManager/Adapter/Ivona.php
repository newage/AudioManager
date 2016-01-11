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

        $handle = $this->getHandle();
        $handle->setUrl($payload->getServiceUrl());
        $handle->setOption(CURLOPT_RETURNTRANSFER, 1);
        $handle->setOption(CURLOPT_POST, true);

        $handle->setOption(CURLOPT_POSTFIELDS, $payload->getPayload());
        $handle->setOption(CURLOPT_HTTPHEADER, $payload->getHeaders());
        $handle->setOption(CURLOPT_SSL_VERIFYPEER, false);

        $response = $handle->execute();
        $this->setHeaders($handle->getInfo());
        return $response;
    }
}
