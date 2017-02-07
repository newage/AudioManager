<?php

namespace AudioManager\Adapter\Polly;

/**
 * Class InitializeOptions
 * @package Adapter\Polly
 */
class InitializeOptions
{
    protected $version;
    protected $region;
    protected $credentials;

    /**
     * InitializeOptions constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        if (!empty($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options
     * @param array $options
     */
    public function setOptions(array $options)
    {
        foreach ($options as $option => $value) {
            $methodName = 'set'.ucfirst($option);
            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     * @return $this
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * @return CredentialsOptions
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * @param CredentialsOptions|array $credentials
     * @return CredentialsOptions
     */
    public function setCredentials($credentials = [])
    {
        if ($credentials instanceof CredentialsOptions) {
            $this->credentials = $credentials;
        } elseif (is_array($credentials)) {
            $this->credentials = new CredentialsOptions($credentials);
        } else {
            $this->credentials = new CredentialsOptions();
        }
        return $this->credentials;
    }
}
