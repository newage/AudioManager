<?php

namespace AudioManager\Adapter\Request;

use AudioManager\Request\CurlRequest;

class CurlRequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurlRequest
     */
    protected $request;

    public function setUp()
    {
        $this->request = new CurlRequest();
    }

    public function testSetUrl()
    {
        $response = $this->request->setUrl('http://url');
        $this->assertTrue($response instanceof CurlRequest);
    }

    public function testDestruct()
    {
        unset($this->request);
    }
}
