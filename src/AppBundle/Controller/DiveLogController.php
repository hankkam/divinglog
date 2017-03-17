<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Diver;
use AppBundle\Service\DiveLogService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Dive log controller.
 */
class DiveLogController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /** @var \AppBundle\Service\DiveLogService  */
    private $diveLogService;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     * @param \AppBundle\Service\DiveLogService
     */
    public function __construct(
        EngineInterface $templating,
        FormFactoryInterface $formFactory,
        Session $session,
        Router $router,
        DiveLogService $diveLogService
    ) {
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->router = $router;
        $this->diveLogService = $diveLogService;
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allAction(Diver $diver, Request $request)
    {
        $data =  array(
            'divelogs' => $diver->getDiveLogs(),
            'page' => 'AppBundle:divelogs:table.html.twig',
            'fullname' => $diver->getFullName(),
        );

        return $this->render($data);
    }

    /**
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function render(array $data)
    {
        return $this->templating->renderResponse("AppBundle:divelogs:index.html.twig", $data);
    }
}
