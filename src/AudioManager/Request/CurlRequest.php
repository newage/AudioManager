<?php

namespace AudioManager\Request;

/**
 * Class CurlRequest
 * @package AudioManager\Request
 */
class CurlRequest implements RequestInterface
{
    /**
     * Curl handle
     * @var resource
     */
    private $handle;

    /**
     * Constructor
     * Create curl handle
     * @param $url
     */
    public function __construct($url = null)
    {
        $this->handle = curl_init($url);
    }

    /**
     * Close connection
     */
    public function __destruct()
    {
        $this->close();
    }

    /**
     * @param $url
     * @return bool
     */
    public function setUrl($url)
    {
        return $this->setOption(CURLOPT_URL, $url);
    }
    
    /**
     * Set option
     * @param string $name
     * @param string|int $value
     * @return bool
     */
    public function setOption($name, $value)
    {
        return curl_setopt($this->handle, $name, $value);
    }

    /**
     * Execute request
     * @return mixed
     */
    public function execute()
    {
        return curl_exec($this->handle);
    }

    /**
     * Get info from request
     * @param string $name
     * @return mixed
     */
    public function getInfo($name = null)
    {
        return curl_getinfo($this->handle, $name);
    }

    /**
     * Get error message
     * @return mixed
     */
    public function getError()
    {
        return curl_error($this->handle);
    }

    /**
     * Close http connection
     * @return void
     */
    public function close()
    {
        curl_close($this->handle);
    }
}
