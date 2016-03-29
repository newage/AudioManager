<?php

namespace AudioManager\Adapter\Google;

use AudioManager\Exception\RuntimeException;
use AudioManager\Adapter\Options\Google as Options;

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

    public function testEncodingOption()
    {
        $encoding = 'UTF-8';
        $this->assertFalse($this->options->hasEncoding());
        $this->options->setOptions(['encoding' => $encoding]);
        $this->assertTrue($this->options->hasEncoding());
        $this->assertEquals($encoding, $this->options->getEncoding());
    }

    public function testLanguageOption()
    {
        $language = 'en';
        $this->assertFalse($this->options->hasLanguage());
        $this->options->setOptions(['language' => $language]);
        $this->assertTrue($this->options->hasLanguage());
        $this->assertEquals($language, $this->options->getLanguage());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testLanguageException()
    {
        $this->options->getLanguage();
    }

    /**
     * @expectedException RuntimeException
     */
    public function testOptionsException()
    {
        $this->options->setOption('test', 'value');
    }
}
