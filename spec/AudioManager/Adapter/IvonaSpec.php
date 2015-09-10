<?php

namespace spec\AudioManager\Adapter;

use AudioManager\Adapter\Ivona\Authenticate;
use AudioManager\Adapter\Ivona\Options;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IvonaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona');
        $this->shouldImplement('AudioManager\Adapter\AdapterInterface');
    }

    function let(Authenticate $auth)
    {
        $this->beConstructedWith($auth);
    }

    function it_set_authenticator(Authenticate $auth)
    {
        $this->setAuthenticate($auth)->shouldHaveType('AudioManager\Adapter\Ivona');
        $this->getAuthenticate()->shouldImplement($auth);
    }

    function it_is_header()
    {
        $this->setHeaders(['code' => 200]);
        $this->getHeaders()->shouldHaveKeyWithValue('code', 200);
    }

    function it_set_options(Options $options)
    {
        $this->setOptions($options)->shouldHaveType('AudioManager\Adapter\Ivona');
        $this->getOptions()->shouldHaveType('AudioManager\Adapter\Ivona\Options');
    }

    function it_get_empty_options()
    {
        $this->shouldThrow()->during('getOptions', []);
    }
}
