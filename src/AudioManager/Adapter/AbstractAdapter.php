<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\OptionsInterface;

/**
 * Class AbstractAdapter
 * @package AudioManager\Adapter
 */
abstract class AbstractAdapter
{
    protected $headers = [];
    protected $options;

    /**
     * Constructor
     * Init options object
     */
    public function __construct()
    {
        $this->options = $this->initOptions();
    }

    /**
     * Get audio for text from adapter
     * @param string $text
     * @return mixed
     */
    abstract public function read($text);

    /**
     * Init options
     * @return OptionsInterface
     */
    abstract protected function initOptions();

    /**
     * Get options object
     * @return OptionsInterface
     */
    abstract public function getOptions();

    /**
     * Get headers after curl
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set headers after curl
     * @param array $headers
     */
    protected function setHeaders($headers)
    {
        $this->headers = $headers;
    }
}
