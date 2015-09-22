<?php

namespace AudioManager\Adapter\Ivona;

class Options
{

    const DEFAULT_USERAGENT = 'TestClient 1.0';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var Authenticate
     */
    protected $authenticate;

    /**
     * @param Authenticate $authenticate
     */
    public function __construct(Authenticate $authenticate)
    {
        $this->setAuthenticate($authenticate);
    }

    /**
     * Set user agent
     * @param $value
     * @return $this
     */
    public function setUserAgent($value)
    {
        $this->userAgent = $value;
        return $this;
    }

    /**
     * Get user agent
     * @return string
     */
    public function getUserAgent()
    {
        if (empty($this->userAgent)) {
            $this->userAgent = self::DEFAULT_USERAGENT;
        }
        return $this->userAgent;
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
     * Set authenticate object
     * @param Authenticate $authenticate
     * @return $this
     */
    public function setAuthenticate(Authenticate $authenticate)
    {
        $this->authenticate = $authenticate;
        return $this;
    }
}
