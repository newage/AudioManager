<?php

namespace AudioManager\Adapter;

/**
 * Google TTS adapter
 * @package AudioManager\Adapter
 */
class Google implements AdapterInterface
{

    protected $headers = [];

    /**
     * @param $text
     * @param null $options
     * @return mixed|void
     */
    public function read($text, $options = null)
    {
        $path = sprintf('http://translate.google.com/translate_tts?ie=UTF-8&tl=en&q=%s', urlencode($text));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $path);
        $response = curl_exec($curl);
        $this->setHeaders(curl_getinfo($curl));
        curl_close($curl);

        return $response;
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
}
