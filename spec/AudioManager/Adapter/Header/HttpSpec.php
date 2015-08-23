<?php

namespace spec\AudioManager\Adapter\Header;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HttpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Header\Http');
    }
}
