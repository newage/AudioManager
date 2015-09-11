<?php

namespace spec\AudioManager\Adapter\Ivona;

use AudioManager\Adapter\Ivona\Authenticate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ServiceHeadersSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona\Payload');
    }

    function it_set_userAgent()
    {
        $this->setUserAgent('X-Host')->shouldHaveType('AudioManager\Adapter\Ivona\Payload');
        $this->getUserAgent()->shouldBe('X-Host');
    }

    function it_set_authenticate(Authenticate $auth)
    {
        $this->setAuthenticate($auth)->shouldHaveType('AudioManager\Adapter\Ivona\Payload');
        $this->getAuthenticate()->shouldBe($auth);
    }
}
