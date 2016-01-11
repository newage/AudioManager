<?php

namespace AudioManager\Adapter;

use AudioManager\Adapter\Options\Google as Options;

/**
 * Google TTS adapter
 * @package AudioManager\Adapter
 */
class Google extends AbstractAdapter implements AdapterInterface
{
    /**
     * @param string $query
     * @return mixed
     */
    public function read($query)
    {
        $handle = $this->getHandle();
        $handle->setUrl($this->createUrl($query));
        $handle->setOption(CURLOPT_RETURNTRANSFER, 1);
        $response = $handle->execute();
        $this->setHeaders($handle->getInfo());
        return $response;
    }

    /**
     * Create url from options
     * @param string $query
     * @return string
     */
    protected function createUrl($query)
    {
        $options = $this->getOptions();
        $path = sprintf(
            'http://translate.google.com/translate_tts?ie=%s&tl=%s&q=%s',
            $options->hasEncoding() ? $options->getEncoding() : 'UTF-8',
            $options->getLanguage(),
            urlencode($query)
        );
        return $path;
    }

    /**
     * Get options for google adapter
     * @return Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get options object
     * @return Options
     */
    protected function initOptions()
    {
        return new Options();
    }
}
