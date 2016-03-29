<?php

namespace AudioManager\Adapter;

/**
 * Interface AdapterInterface
 * @package AudioManager\Adapter
 */
interface AdapterInterface
{
    /**
     * Read resource
     * @param $text
     * @return mixed
     */
    public function read($text);

    /**
     * Get headers for resource
     * @return mixed
     */
    public function getHeaders();
}
