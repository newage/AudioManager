<?php

namespace spec\AudioManager\Adapter\Ivona;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthenticateSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona\Authenticate');
    }

    function it_set_public_key()
    {
        $this->setSecretKey('secret_key')->shouldHaveType('AudioManager\Adapter\Ivona\Authenticate');
        $this->getSecretKey()->shouldBe('secret_key');

    }

    function it_set_access_key()
    {
        $this->setAccessKey('access_key')->shouldHaveType('AudioManager\Adapter\Ivona\Authenticate');;
        $this->getAccessKey()->shouldBe('access_key');
    }
}
