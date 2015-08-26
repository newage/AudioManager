<?php

namespace spec\AudioManager\Adapter\Ivona;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthenticateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona\Authenticate');
        $this->shouldImplement('AudioManager\Adapter\Ivona\AuthenticateInterface');
    }

    function it_set_public_key()
    {

    }

    function it_set_access_key()
    {

    }
}
