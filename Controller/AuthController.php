<?php

namespace Zorbus\LinkedInBundle\Controller;

use GuzzleHttp\Message\Response as GuzzleResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zorbus\LinkedInBundle\Event\LinkedInAuthorizeEvent;
use Zorbus\LinkedInBundle\Event\LinkedInEvents;
use Zorbus\LinkedInBundle\Event\LinkedInTokenEvent;
use DateTime;

class AuthController extends Controller
{
    public function authorizeAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager.auth');

        $key = $this->container->getParameter('zorbus_linkedin.key');
        $scope = explode(',', $this->container->getParameter('zorbus_linkedin.scope'));
        $url = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $event = new LinkedInAuthorizeEvent($url);
        $this->get('event_dispatcher')->dispatch(LinkedInEvents::AUTHORIZE, $event);

        $manager->authorize($key, $scope, $event->getUrl());
    }

    public function authenticateAction(Request $request)
    {
        /** @var \Zorbus\LinkedIn\Manager $manager */
        $manager = $this->get('zorbus_linkedin.manager.auth');

        $code = $request->query->get('code');
        $state = $request->query->get('state');
        $secret = $this->container->getParameter('zorbus_linkedin.secret');
        $key = $this->container->getParameter('zorbus_linkedin.key');
        $redirectUrl = $this->generateUrl('zorbus_linkedin.authenticate', [], true);

        $data = $manager->authenticate($code, $state, $secret, $key, $redirectUrl);

        $event = new LinkedInTokenEvent($data['access_token'], new DateTime('+' . $data['expires_in'] . ' seconds'));

        $this->get('event_dispatcher')->dispatch(LinkedInEvents::ACCESS_TOKEN, $event);

        $response = $event->getResponse();
        if ($response instanceof Response) {
            return $response;
        }

        return new Response('LinkedIn connection was successful.');
    }
}