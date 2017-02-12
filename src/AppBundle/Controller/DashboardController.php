<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class DashboardController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage */
    private $tokenStorage;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage $tokenStorage
     */
    public function __construct(EngineInterface $templating, TokenStorage $tokenStorage) {
        $this->templating = $templating;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        dump($this->tokenStorage->getToken()->getUser());
        $data = array(
            'username' => $this->tokenStorage->getToken()->getUser()->getUserName()
        );

        return $this->templating->renderResponse('AppBundle:dashboard:index.html.twig', $data);
    }
}
