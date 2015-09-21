<?php

namespace AudioManager\Adapter\Google;

use AudioManager\Exception\RuntimeException;

/**
 * Hold options for google adapter
 * @package AudioManager\Adapter\Google
 */
class Options
{

    protected $language;
    protected $encoding;

    /**
     * Set language option
     * @param $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get language option
     * @return mixed
     */
    public function getLanguage()
    {
        if (null === $this->language) {
            throw new RuntimeException('Need add the language option for google adapter');
        }
        return $this->language;
    }

    /**
     * Set encoding [optional]
     * @param $encoding
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
        return $this;
    }

    /**
     * Get encoding
     * @return mixed
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Has encoding option
     * @return bool
     */
    public function hasEncoding()
    {
        return null !== $this->encoding;
    }
}
