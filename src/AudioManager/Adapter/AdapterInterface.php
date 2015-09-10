<?php

namespace AudioManager\Adapter;

/**
 * Interface AdapterInterface
 * @package AudioManager\Adapter
 */
interface AdapterInterface
{

    /**
     * Read audio from adapter
     * @param string $text
     * @return mixed
     */
    public function read($text);

    /**
     * Get headers after read
     * @return array
     */
    public function getHeaders();

    /**
     * Set options for adapter
     * @param array|Options $options
     * @return $this
     */
    public function setOptions($options);
}
