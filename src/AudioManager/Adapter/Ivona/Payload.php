<?php

namespace AudioManager\Adapter\Ivona;

class Payload
{

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var array
     */
    protected $postData = [];

    /**
     * Constructor
     * @param Options $options
     */
    public function __construct(Options $options)
    {
        $this->setOptions($options);
    }

    /**
     * Get service headers
     * @param $serviceType
     * @return array
     */
    public function getHeaders($serviceType)
    {
        $this->getOptions()->getAuthenticate();
        $this->getOptions()->getAuthenticate()->setPostData($this->getPostData());

        $headers = [
            'Content-Type: application/json',
            'Host: tts.eu-west-1.ivonacloud.com',
            'User-Agent: ' . $this->getOptions()->getUserAgent()
        ];

        return array_merge(
            $headers,
            $this->getOptions()->getAuthenticate()->getHeader($serviceType)
        );
    }

    /**
     * @param array $postData
     * @return $this
     */
    public function setPostData($postData)
    {
        $this->postData = $postData;
        return $this;
    }

    /**
     * Get post data for service
     * @return array
     */
    public function getPostData()
    {
        return $this->postData;
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
