<?php

namespace AudioManager\Adapter\Options;

use AudioManager\Exception\RuntimeException;

/**
 * @package Adapter\Options
 */
abstract class AbstractOptions implements OptionsInterface
{
    /**
     * Set option
     * Fluent interface
     * @param $name
     * @param $value
     * @return OptionsInterface
     */
    public function setOption($name, $value)
    {
        $methodName = 'set' . ucfirst($name);
        if (!method_exists($this, $methodName)) {
            throw new RuntimeException('Method not exists: ' . $methodName);
        }
        return $this->$methodName($value);
    }

    /**
     * Set options
     * @param array $options
     * @return OptionsInterface
     */
    public function setOptions(array $options)
    {
        foreach ($options as $name => $value) {
            $this->setOption($name, $value);
        }
        return $this;
    }
}
