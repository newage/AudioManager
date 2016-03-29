<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\Ivona as Options;
use AudioManager\Adapter\Ivona\Payload;

/**
 * Adapter for Ivona TTS
 * @package AudioManager\Adapter
 * @method Options getOptions()
 */
class Ivona extends AbstractAdapter implements AdapterInterface
{
    /**
     * @var Payload
     */
    protected $payload;

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
        $payload = $this->getPayload($text);

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

    /**
     * Initialize payload
     * @param $text
     * @return Payload
     */
    private function initPayload($text)
    {
        $payload = new Payload();
        $payload->setOptions($this->getOptions());
        $payload->setQueryText($text);
        return $payload->createPayload();
    }

    /**
     * @param string $text
     * @return Payload
     */
    public function getPayload($text)
    {
        if (!$this->payload instanceof Payload) {
            $this->payload = $this->initPayload($text);
        }
        return $this->payload;
    }

    /**
     * @param Payload $payload
     */
    public function setPayload(Payload $payload)
    {
        $this->payload = $payload;
    }
}
