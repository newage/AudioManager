<?php

namespace spec\AudioManager\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IvonaSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Adapter\Ivona');
    }
}
