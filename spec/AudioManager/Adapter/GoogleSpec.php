<?php

namespace spec\AudioManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GoogleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Google');
        $this->shouldImplement('AudioManager\Adapter\AdapterInterface');
    }

    function it_is_read_without_options()
    {
        $this->shouldThrow()->during('read', ['some text']);
    }

    function it_is_read_with_language_options()
    {
        $this->shouldThrow()->during('read', ['some text', []]);
    }

    function it_is_header()
    {
        $this->setHeaders(['code' => 200]);
        $this->getHeaders()->shouldHaveKeyWithValue('code', 200);
    }

    function it_set_options()
    {
        $this->setOptions(['encoding' => 'UTF-8', 'language' => 'en'])->shouldHaveType('AudioManager\Adapter\Google');
        $this->getOptions()->shouldHaveType('AudioManager\Adapter\Google\Options');
    }

    function it_set_fake_options()
    {
        $this->shouldThrow()->during('setOptions', [1]);
    }

    function it_get_empty_options()
    {
        $this->shouldThrow()->during('getOptions', []);
    }
}
