<?php

namespace AudioManager;

use AudioManager\Adapter\AdapterInterface;

/**
 * Class Manager
 * @package AudioManager
 */
class Manager
{

    /**
     * AdapterInterface
     * @var
     */
    protected $adapter;

    /**
     * Constructor
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }

    /**
     * Set adapter
     * @param AdapterInterface $adapter
     * @return $this
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * Get adapter
     * @return AdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Read audio from adapter
     * @param $text
     * @param array $options
     * @return mixed
     */
    public function read($text, $options = [])
    {
        return $this->getAdapter()->read($text, $options);
    }

    /**
     * Get headers from adapter
     * @return mixed
     */
    public function getHeaders()
    {
        return $this->getAdapter()->getHeaders();
    }
}
