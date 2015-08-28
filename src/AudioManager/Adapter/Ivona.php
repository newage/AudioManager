<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Ivona\AuthenticateInterface;
use AudioManager\Adapter\Ivona\Options;
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

    public function read($text, $options = [])
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
        return $this->headers;
    }

    public function setOptions($options)
    {
        if (is_array($options)) {
            $this->options = new Options($options);
        } elseif ($options instanceof Options) {
            $this->options = $options;
        } elseif (!empty($options)) {
            throw new RuntimeException('Options must be an array or an `Options` object');
        }

        return $this;
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
            throw new RuntimeException('An authenticate object need setup for the Ivona adapter');
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
