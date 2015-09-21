<?php

namespace Test\AudioManager\Adapter\Ivona;

use AudioManager\Adapter\Ivona\Options;
use AudioManager\Adapter\Ivona\Authenticate;

class OptionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Options
     */
    protected $options;

    public function setUp()
    {
        $secretKey = 'secret';
        $accessKey = 'access';
        $this->options = new Options(new Authenticate($secretKey, $accessKey));
    }

    public function testUserAgent()
    {
        $userAgent = 'Chrome';
        $this->assertEquals(Options::DEFAULT_USERAGENT, $this->options->getUserAgent());
        $this->options->setUserAgent($userAgent);
        $this->assertEquals($userAgent, $this->options->getUserAgent());
    }

    public function testGetAuthenticate()
    {
        $this->assertTrue($this->options->getAuthenticate() instanceof Authenticate);
    }
}
