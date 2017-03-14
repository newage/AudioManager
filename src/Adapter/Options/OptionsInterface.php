<?php

namespace AudioManager\Adapter\Options;

/**
 * Interface OptionsInterface
 * @package AudioManager\Adapter
 */
interface OptionsInterface
{
    /**
     * Set option
     * @param $name
     * @param $value
     * @return OptionsInterface
     */
    public function setOption($name, $value);

    /**
     * Set options
     * @param array $options
     * @return OptionsInterface
     */
    public function setOptions(array $options);

    /**
     * Set language
     * @param string $language
     * @return OptionsInterface
     */
    public function setLanguage($language);

    /**
     * Get language
     * @return string
     */
    public function getLanguage();

    /**
     * Set voice
     * @param string $voice
     * @return OptionsInterface
     */
    public function setVoice($voice);

    /**
     * Get voice
     * @return string
     */
    public function getVoice();
}
