<?php

namespace AudioManager\Adapter\Options;

use AudioManager\Adapter\Ivona\Authenticate;

/**
 * Class Ivona
 * @package AudioManager\Adapter\Options
 */
class Ivona extends AbstractOptions implements OptionsInterface
{

    const DEFAULT_USERAGENT = 'TestClient 1.0';

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * Secret key for authenticate
     * @var string
     */
    protected $secretKey;

    /**
     * Access key for authenticate
     * @var string
     */
    protected $accessKey;

    /**
     * @var Authenticate
     */
    protected $authenticate;

    /**
     * @var string
     */
    protected $language = 'en-US';

    /**
     * @var string
     */
    protected $voice = 'Salli';

    /**
     * @var string
     */
    protected $outputFormatCodec = 'MP3';

    /**
     * @var string
     */
    protected $outputSampleRate = '22050';

    /**
     * @var string
     */
    protected $parametersRate = 'slow';

    /**
     * Set user agent
     * @param $value
     * @return $this
     */
    public function setUserAgent($value)
    {
        $this->userAgent = $value;
        return $this;
    }

    /**
     * Get user agent
     * @return string
     */
    public function getUserAgent()
    {
        if (empty($this->userAgent)) {
            $this->userAgent = self::DEFAULT_USERAGENT;
        }
        return $this->userAgent;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     * @return $this
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessKey()
    {
        return $this->accessKey;
    }

    /**
     * @param string $accessKey
     * @return $this
     */
    public function setAccessKey($accessKey)
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    /**
     * Get authenticate object
     * @return Authenticate
     */
    public function getAuthenticate()
    {
        if ($this->authenticate === null) {
            $this->authenticate = new Authenticate($this->getSecretKey(), $this->getAccessKey());
        }
        return $this->authenticate;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string
     */
    public function getVoice()
    {
        return $this->voice;
    }

    /**
     * @param string $voice
     * @return $this
     */
    public function setVoice($voice)
    {
        $this->voice = $voice;
        return $this;
    }

    /**
     * @return string
     */
    public function getOutputFormatCodec()
    {
        return $this->outputFormatCodec;
    }

    /**
     * @param string $outputFormatCodec
     * @return $this
     */
    public function setOutputFormatCodec($outputFormatCodec)
    {
        $this->outputFormatCodec = $outputFormatCodec;
        return $this;
    }

    /**
     * @return string
     */
    public function getOutputSampleRate()
    {
        return $this->outputSampleRate;
    }

    /**
     * @param string $outputSampleRate
     * @return $this
     */
    public function setOutputSampleRate($outputSampleRate)
    {
        $this->outputSampleRate = $outputSampleRate;
        return $this;
    }

    /**
     * @return string
     */
    public function getParametersRate()
    {
        return $this->parametersRate;
    }

    /**
     * @param string $parametersRate
     * @return $this
     */
    public function setParametersRate($parametersRate)
    {
        $this->parametersRate = $parametersRate;
        return $this;
    }
}
