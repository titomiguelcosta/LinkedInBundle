<?php

namespace Zorbus\LinkedInBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class LinkedInAuthorizeEvent extends Event
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

}