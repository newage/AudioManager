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
}
