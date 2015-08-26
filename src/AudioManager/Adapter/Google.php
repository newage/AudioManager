<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Google\Options;
use AudioManager\Exception\RuntimeException;

/**
 * Google TTS adapter
 * @package AudioManager\Adapter
 */
class Google implements AdapterInterface
{

    protected $headers = [];
    protected $options;

    /**
     * @param string $query
     * @param array|Options|null $options
     * @return mixed
     */
    public function read($query, $options = null)
    {
        $this->setOptions($options);

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
     * @param $query
     * @return string
     */
    protected function createUrl($query)
    {
        $options = $this->getOptions();
        $path = sprintf(
            'http://translate.google.com/translate_tts?ie=%s&tl=%s&q=%s',
            $options->hasEncoding() ? $options->getEncoding(): 'UTF-8',
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
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set options for google adapter
     * @param array|Options $options
     * @return $this
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            $this->options = new Options($options);
        } elseif ($options instanceof Options) {
            $this->options = $options;
        } elseif (null !== $options) {
            throw new RuntimeException('Options must be an array or an `Options` object');
        }

        return $this;
    }

    /**
     * Get options
     * @return Options
     */
    public function getOptions()
    {
        if (null === $this->options) {
            throw new RuntimeException('Need set up options');
        }
        return $this->options;
    }
}
