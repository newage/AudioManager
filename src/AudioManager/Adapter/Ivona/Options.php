<?php

namespace AudioManager\Adapter\Ivona;

class Options
{

    const DEFAULT_USERAGENT = 'TestClient 1.0';

    protected $userAgent;

    public function setUserAgent($value)
    {
        $this->userAgent = $value;
        return $this;
    }

    public function getUserAgent()
    {
        if (empty($this->userAgent)) {
            $this->userAgent = self::DEFAULT_USERAGENT;
        }
        return $this->userAgent;
    }
}
