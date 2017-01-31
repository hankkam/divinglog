<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Security controller.
 */
class SecurityController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Symfony\Component\Security\Http\Authentication\AuthenticationUtils $authenticationUtils
     */
    public function __construct(
        EngineInterface $templating,
        AuthenticationUtils $authenticationUtils
    ) {
        $this->templating = $templating;
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function loginAction(Request $request)
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $this->templating->renderResponse("AppBundle:security:login.html.twig", [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * This is the route the user can use to logout.
     *
     * But, this will never be executed. Symfony will intercept this first
     * and handle the logout automatically. See logout in app/config/security.yml
     */
    public function logoutAction()
    {
        throw new \Exception('This should never be reached!');
    }
}
