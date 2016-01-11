<?php

namespace AudioManager\Request;

/**
 * Interface HttpRequest
 * @package AudioManager\Request
 */
interface RequestInterface
{
    /**
     * Set option
     * @param string $name
     * @param string|int $value
     * @return $this
     */
    public function setOption($name, $value);

    /**
     * Set url
     * @param $url
     * @return mixed
     */
    public function setUrl($url);

    /**
     * Execute request
     * @return mixed
     */
    public function execute();

    /**
     * Get info from request
     * @param string $name
     * @return mixed
     */
    public function getInfo($name = null);

    /**
     * Get error message
     * @return mixed
     */
    public function getError();

    /**
     * Close http connection
     * @return mixed
     */
    public function close();
}
