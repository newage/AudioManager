<?php

namespace AudioManager\Adapter\Options;

use AudioManager\Adapter\Polly\InitializeOptions;

/**
 * Class Polly
 * @package Adapter\Options
 */
class Polly extends AbstractOptions implements OptionsInterface
{
    protected $initialize;

    protected $outputFormat = 'mp3';
    protected $lexiconNames = [];
    protected $sampleRate = '16000';
    protected $textType = 'text';
    protected $voiceId = 'Salli';
    protected $language = 'en-US';

    /**
     * @return InitializeOptions
     */
    public function getInitializeOptions()
    {
        return $this->initialize;
    }

    /**
     * @param InitializeOptions|array $options
     * @return InitializeOptions
     */
    public function initialize($options = [])
    {
        if ($options instanceof InitializeOptions) {
            $this->initialize = $options;
        } elseif (is_array($options)) {
            $this->initialize = new InitializeOptions($options);
        } else {
            $this->initialize = new InitializeOptions();
        }
        return $this->initialize;
    }

    /**
     * @inheritdoc
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @inheritdoc
     */
    public function setVoice($voice)
    {
        return $this->setVoiceId($voice);
    }

    /**
     * @inheritdoc
     */
    public function getVoice()
    {
        return $this->getVoiceId();
    }

    /**
     * @return mixed
     */
    public function getOutputFormat()
    {
        return (string)$this->outputFormat;
    }

    /**
     * @param mixed $outputFormat
     * @return $this
     */
    public function setOutputFormat($outputFormat)
    {
        $this->outputFormat = $outputFormat;
        return $this;
    }

    /**
     * @return array
     */
    public function getLexiconNames()
    {
        return (array)$this->lexiconNames;
    }

    /**
     * @param array $lexiconNames
     * @return $this
     */
    public function setLexiconNames($lexiconNames)
    {
        $this->lexiconNames = $lexiconNames;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSampleRate()
    {
        return (string)$this->sampleRate;
    }

    /**
     * @param mixed $sampleRate
     * @return $this
     */
    public function setSampleRate($sampleRate)
    {
        $this->sampleRate = $sampleRate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTextType()
    {
        return (string)$this->textType;
    }

    /**
     * @param mixed $textType
     * @return $this
     */
    public function setTextType($textType)
    {
        $this->textType = $textType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVoiceId()
    {
        return (string)$this->voiceId;
    }

    /**
     * @param mixed $voiceId
     * @return $this
     */
    public function setVoiceId($voiceId)
    {
        $this->voiceId = $voiceId;
        return $this;
    }
}
