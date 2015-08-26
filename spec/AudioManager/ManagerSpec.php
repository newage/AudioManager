<?php

namespace spec\AudioManager;

use AudioManager\Adapter\Google;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use AudioManager\Adapter\AdapterInterface;

class ManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AudioManager\Manager');
    }

    function let(AdapterInterface $adapter)
    {
        $this->beConstructedWith($adapter);
        $this->getAdapter()->shouldBe($adapter);
    }

    function it_is_adapter(AdapterInterface $adapter)
    {
        $this->setAdapter($adapter)->shouldHaveType('AudioManager\Manager');
        $this->getAdapter()->shouldBe($adapter);
    }

    function it_is_read()
    {
        $this->read('some text', []);
    }

    function it_get_headers()
    {
        $this->getHeaders();
    }
}
