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
     * @param $text
     * @param null $options
     * @return mixed
     */
    public function read($text, $options = null);

    /**
     * Get headers after read
     * @return mixed
     */
    public function getHeaders();

    /**
     * Set options for adapter
     * @param $options
     * @return mixed
     */
    public function setOptions($options);
}
