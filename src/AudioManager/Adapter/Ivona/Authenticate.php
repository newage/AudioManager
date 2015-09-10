<?php

namespace AudioManager\Adapter\Ivona;

/**
 * Simple authenticator with secret key and success key for Ivona adapter
 * @package AudioManager\Adapter\Ivona
 */
class Authenticate
{

    protected $secretKey;
    protected $accessKey;

    /**
     * Set secret key
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * Get secret key
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * Set access key
     * @param string $accessKey
     * @return $this
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Get access key
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }
}
