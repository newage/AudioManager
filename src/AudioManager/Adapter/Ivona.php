<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Ivona\AuthenticateInterface;
use AudioManager\Exception\RuntimeException;

/**
 * Adapter for Ivona TTS
 * @package AudioManager\Adapter
 */
class Ivona implements AdapterInterface
{

    protected $authenticate;
    protected $headers = [];
    protected $options;

    /**
     * Constructor
     * @param AuthenticateInterface $authenticate
     */
    public function __construct(AuthenticateInterface $authenticate)
    {
        $this->setAuthenticate($authenticate);
    }

    public function read($text, $options = null)
    {
        // TODO: Implement read() method.
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    public function setOptions($options)
    {
        // TODO: Implement setOptions() method.
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get authenticate object
     * @return AuthenticateInterface
     */
    public function getAuthenticate()
    {
        if (null === $this->authenticate) {
            throw new RuntimeException('An authenticate object need setup for the Ivona');
        }
        return $this->authenticate;
    }

    /**
     * Set authenticate object
     * @param AuthenticateInterface $authenticate
     * @return $this
     */
    public function setAuthenticate(AuthenticateInterface $authenticate)
    {
        $this->authenticate = $authenticate;
        return $this;
    }
}
