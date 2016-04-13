<?php

namespace AudioManager\Adapter\Options;

use AudioManager\Adapter\Ivona\Authenticate;

/**
 * Class Ivona
 * @package AudioManager\Adapter\Options
 */
class Ivona extends AbstractOptions
{

    const DEFAULT_USERAGENT = 'TestClient 1.0';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * Secret key for authenticate
     * @var string
     */
    protected $secretKey;

    /**
     * Access key for authenticate
     * @var string
     */
    protected $accessKey;

    /**
     * @var Authenticate
     */
    protected $authenticate;

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
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
    }

    /**
     * Get authenticate object
     * @return Authenticate
     */
    public function getAuthenticate()
    {
        if ($this->authenticate === null) {
            $this->authenticate = new Authenticate($this->getSecretKey(), $this->getAccessKey());
        }
        return $this->authenticate;
    }
}
