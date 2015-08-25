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

    function it_is_read()
    {
        $this->read('some text');
    }

    function it_is_header()
    {
        $this->setHeaders(['code' => 200]);
        $this->getHeaders()->shouldHaveKeyWithValue('code', 200);
    }

    function it_set_options()
    {

    }
}
