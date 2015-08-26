<?php

namespace spec\AudioManager\Adapter\Google;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Google\Options');
    }

    function let()
    {
        $this->beConstructedWith([]);
    }

    function it_set_language()
    {
        $this->setLanguage('en')->shouldHaveType('AudioManager\Adapter\Google\Options');
        $this->getLanguage()->shouldBe('en');
    }

    function it_get_empty_language()
    {
        $this->shouldThrow()->during('getLanguage', []);
    }

    function it_set_encoding()
    {
        $this->setEncoding('UTF-8')->shouldHaveType('AudioManager\Adapter\Google\Options');
        $this->shouldHaveEncoding();
        $this->getEncoding()->shouldBe('UTF-8');
    }
}
