<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Header\Http;

/**
 * Google TTS adapter
 * @package AudioManager\Adapter
 */
class Google implements AdapterInterface
{

    protected $headers;

    /**
     * @param $text
     * @param null $options
     * @return mixed|void
     */
    public function read($text, $options = null)
    {
        return null;
    }

    /**
     * Get HTTP headers after read
     */
    public function getHeaders()
    {
        return new Http();
    }
}
