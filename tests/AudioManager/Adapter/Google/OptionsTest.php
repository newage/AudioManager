<?php

namespace Tests\AudioManager\Adapter\Google;

use AudioManager\Adapter\Google\Options;

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

    public function testEncoding()
    {
        $encoding = 'UTF-8';
        $this->assertFalse($this->options->hasEncoding());
        $this->options->setEncoding($encoding);
        $this->assertTrue($this->options->hasEncoding());
        $this->assertEquals($encoding, $this->options->getEncoding());
    }

    public function testLanguage()
    {
        $language = 'ru';
        $this->options->setLanguage($language);
        $this->assertEquals($language, $this->options->getLanguage());
    }
}
