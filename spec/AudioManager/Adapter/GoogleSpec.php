<?php

namespace spec\AudioManager\Adapter;

use AudioManager\Adapter\Google\Options;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GoogleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Google');
        $this->shouldImplement('AudioManager\Adapter\AdapterInterface');
    }

    function it_is_header()
    {
        $this->setHeaders(['code' => 200]);
        $this->getHeaders()->shouldHaveKeyWithValue('code', 200);
    }

    function it_set_options(Options $options)
    {
        $this->setOptions($options)->shouldHaveType('AudioManager\Adapter\Google');
        $this->getOptions()->shouldHaveType('AudioManager\Adapter\Google\Options');
    }

    function it_get_empty_options()
    {
        $this->shouldThrow()->during('getOptions', []);
    }
}
