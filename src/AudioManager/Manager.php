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
     */
    public function setAdapter(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Get adapter
     * @return mixed
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
}
