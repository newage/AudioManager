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
}
