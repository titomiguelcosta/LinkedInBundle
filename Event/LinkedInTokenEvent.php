<?php

namespace Zorbus\LinkedInBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use DateTime;
use Symfony\Component\HttpFoundation\Response;

class LinkedInTokenEvent extends Event
{
    private $accessToken;
    private $expiresAt;
    private $response = null;

    public function __construct($accessToken, DateTime $expiredAt)
    {
        $this->accessToken = $accessToken;
        $this->expiresAt = $expiredAt;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }
}