<?php

namespace AudioManager\Adapter\Ivona;

use AudioManager\Adapter\Options\Ivona as Options;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Options
     */
    protected $options;

    public function setUp()
    {
        $this->options = new Options();
    }

    public function testUserAgent()
    {
        $userAgent = 'Chrome';
        $this->assertEquals(Options::DEFAULT_USERAGENT, $this->options->getUserAgent());
        $this->options->setUserAgent($userAgent);
        $this->assertEquals($userAgent, $this->options->getUserAgent());
    }

    public function testSecretKey()
    {
        $secretKey = 'secret';
        $this->options->setSecretKey($secretKey);
        $this->assertEquals($secretKey, $this->options->getSecretKey());
    }

    public function testAccessKey()
    {
        $accessKey = 'access';
        $this->options->setAccessKey($accessKey);
        $this->assertEquals($accessKey, $this->options->getAccessKey());
    }

    public function testGetAuthenticate()
    {
        $this->assertTrue($this->options->getAuthenticate() instanceof Authenticate);
    }

    public function testGetLanguage()
    {
        $language = 'ru-RU';
        $this->options->setLanguage($language);
        $this->assertEquals($language, $this->options->getLanguage());
    }

    public function testGetVoice()
    {
        $voice = 'Anna';
        $this->options->setVoice($voice);
        $this->assertEquals($voice, $this->options->getVoice());
    }

    public function testGetOutputFormatCodec()
    {
        $format = 'MP3';
        $this->options->setOutputFormatCodec($format);
        $this->assertEquals($format, $this->options->getOutputFormatCodec());
    }

    public function testGetOutputSampleRate()
    {
        $rate = '44100';
        $this->options->setOutputSampleRate($rate);
        $this->assertEquals($rate, $this->options->getOutputSampleRate());
    }

    public function testGetParametersRate()
    {
        $rate = 'slow';
        $this->options->setParametersRate($rate);
        $this->assertEquals($rate, $this->options->getParametersRate());
    }
}
