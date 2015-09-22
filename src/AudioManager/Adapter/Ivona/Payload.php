<?php

namespace AudioManager\Adapter\Ivona;

use AudioManager\Exception\RuntimeException;

class Payload
{

    const SERVICE_TYPE_LIST = 'ListVoices';
    const SERVICE_TYPE_SPEECH = 'CreateSpeech';

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var array
     */
    protected $payload = [];

    protected $queryText;
    protected $serviceUrl = "https://tts.eu-west-1.ivonacloud.com";
    protected $outputFormatCodec = 'MP3';
    protected $outputSampleRate = '22050';
    protected $parametersRate = 'slow';

    /**
     * Constructor
     * @param Options $options
     * @param string $queryText
     */
    public function __construct(Options $options, $queryText)
    {
        $this->setOptions($options);
        $this->queryText = $queryText;
        $this->createPayload();
    }

    /**
     * Get service headers
     * @return array
     */
    public function getHeaders()
    {
        $this->getOptions()->getAuthenticate()->setPostData($this->getPayload());

        $headers = [
            'Content-Type: application/json',
            'Host: tts.eu-west-1.ivonacloud.com',
            'User-Agent: ' . $this->getOptions()->getUserAgent()
        ];

        return array_merge(
            $headers,
            $this->getOptions()->getAuthenticate()->getHeader(self::SERVICE_TYPE_SPEECH)
        );
    }

    /**
     * Create json object with post parameters
     * @return $this
     * @internal param array $payload
     */
    protected function createPayload()
    {
        $payloadArray = (object)array();
        $payloadArray->Input['Data'] = $this->queryText;
        $payloadArray->Input['Type'] = 'text/plain';

        $payloadArray->OutputFormat['Codec'] = $this->outputFormatCodec;
        $payloadArray->OutputFormat['SampleRate'] = (int) $this->outputSampleRate;
        $payloadArray->Voice['Language'] = 'en-US';
        $payloadArray->Voice['Name'] = 'Salli';
        $payloadArray->Parameters['Rate'] = $this->parametersRate;

        $this->payload = json_encode($payloadArray);
        return $this;
    }

    /**
     * Get post data for service
     * @return array
     */
    public function getPayload()
    {
        if (!isset($this->payload)) {
            throw new RuntimeException('Payload data did not created');
        }
        return $this->payload;
    }

    /**
     * Get url for service with service type
     * @return string
     */
    public function getServiceUrl()
    {
        return $this->serviceUrl . '/' . self::SERVICE_TYPE_SPEECH;
    }

    /**
     * Check available name for service
     * @param string $serviceType
     * @return string
     * @throw
     */
    protected function checkServiceType($serviceType)
    {
        $reflection = new \ReflectionObject($this);
        $constants = $reflection->getConstants();
        if (!in_array($serviceType, $constants)) {
            throw new RuntimeException('Service type does not supports: ' . $serviceType);
        }
        return $serviceType;
    }

    /**
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param Options $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }
}
