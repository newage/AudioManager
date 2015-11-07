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
     * @return mixed
     */
    public function setOption($name, $value);

    /**
     * Set options
     * @param array $options
     * @return mixed
     */
    public function setOptions(array $options);
}
