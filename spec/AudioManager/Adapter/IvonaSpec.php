<?php

namespace spec\AudioManager\Adapter;

use AudioManager\Adapter\Ivona\AuthenticateInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IvonaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona');
        $this->shouldImplement('AudioManager\Adapter\AdapterInterface');
    }

    function let(AuthenticateInterface $auth)
    {
        $this->beConstructedWith($auth);
    }

    function it_set_authenticator(AuthenticateInterface $auth)
    {
        $this->setAuthenticate($auth)->shouldHaveType('AudioManager\Adapter\Ivona');
        $this->getAuthenticate()->shouldImplement($auth);
    }

    function it_get_empty_authenticator()
    {
        $this->shouldThrow()->during('getAuthenticate', []);
    }
}
