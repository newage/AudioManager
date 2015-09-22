<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Google\Options;

/**
 * Google TTS adapter
 * @package AudioManager\Adapter
 */
class Google implements AdapterInterface
{

    protected $headers = [];
    protected $options;

    /**
     * Constructor
     * @param Options $options
     */
    public function __construct(Options $options)
    {
        $this->setOptions($options);
    }

    /**
     * @param string $query
     * @return mixed
     */
    public function read($query)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $this->createUrl($query));

        $response = curl_exec($curl);
        $this->setHeaders(curl_getinfo($curl));

        curl_close($curl);

        return $response;
    }

    /**
     * Create url from options
     * @param string $query
     * @return string
     */
    protected function createUrl($query)
    {
        $options = $this->getOptions();
        $path = sprintf(
            'http://translate.google.com/translate_tts?ie=%s&tl=%s&q=%s',
            $options->hasEncoding() ? $options->getEncoding() : 'UTF-8',
            $options->getLanguage(),
            urlencode($query)
        );
        return $path;
    }
    
    /**
     * Get HTTP headers after read
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set HTTP headers after read
     * @param array $headers
     */
    protected function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set options for google adapter
     * @param Options $options
     * @return $this
     */
    public function setOptions(Options $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }
}
