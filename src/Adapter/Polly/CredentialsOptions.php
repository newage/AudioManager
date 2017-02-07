<?php

namespace AudioManager\Adapter\Polly;

use AudioManager\Exception\RuntimeException;

/**
 * @package Adapter\Polly
 */
class CredentialsOptions
{
    protected $key;
    protected $secret;

    /**
     * CredentialsOptions constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            if (isset($options['key']) && isset($options['secret'])) {
                $this->key = $options['key'];
                $this->secret = $options['secret'];
            } else {
                throw new RuntimeException('Need to setup array[\'key\'=>\'\',\'secret\'=>\'\']');
            }
        }
    }

    /**
     * @return string
     */
    public function getKey()
    {
        if (!$this->key) {
            throw new RuntimeException('Need setup `key` to credentials');
        }
        return $this->key;
    }

    /**
     * @param string $key
     * @return CredentialsOptions
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        if (!$this->key) {
            throw new RuntimeException('Need setup `secret` to credentials');
        }
        return $this->secret;
    }

    /**
     * @param string $secret
     * @return CredentialsOptions
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
        return $this;
    }
}
