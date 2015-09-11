<?php

namespace AudioManager\Adapter\Ivona;

class Payload
{

    /**
     * @var Options
     */
    protected $options;

    /**
     * @var Authenticate
     */
    protected $authenticate;

    /**
     * @var array
     */
    protected $postData;

    /**
     * Get service headers
     * @return array
     */
    public function getHeaders()
    {
        $headers = [
            'Content-Type: application/json',
            'Host: tts.eu-west-1.ivonacloud.com',
            'User-Agent: ' . $this->getOptions()->getUserAgent()
        ];
        return array_merge($headers, $this->getAuthenticate()->getHeader());
    }

    /**
     * Get post data for service
     * @return array
     */
    public function getPost()
    {
        if (empty($this->postData)) {
            $this->postData = [];
        }

        return $this->postData;
    }
    
    /**
     * Set authenticate object
     * @param Authenticate $auth
     * @return $this
     */
    public function setAuthenticate(Authenticate $auth)
    {
        $this->authenticate = $auth;
        return $this;
    }

    /**
     * Get authenticate object
     * @return Authenticate
     */
    public function getAuthenticate()
    {
        return $this->authenticate;
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
