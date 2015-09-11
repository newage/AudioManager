<?php

namespace spec\AudioManager\Adapter\Ivona;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OptionsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona\Options');
    }

    function it_set_userAgent()
    {
        $this->setUserAgent('Test')->shouldHaveType('AudioManager\Adapter\Ivona\Options');;
        $this->getUserAgent()->shouldBe('Test');
    }

    function it_get_default_serAgent()
    {
        $this->getUserAgent()->shouldBe('TestClient 1.0');
    }
}
