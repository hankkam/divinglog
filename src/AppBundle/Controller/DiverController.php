<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Diver;
use AppBundle\Form\DiverType;
use AppBundle\Service\DiverService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Diver controller.
 */
class DiverController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \AppBundle\Service\DiverService */
    private $diverService;

    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \AppBundle\Service\DiverService $diverService
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    public function __construct(
        EngineInterface $templating,
        DiverService $diverService,
        FormFactoryInterface $formFactory,
        Session $session,
        Router $router
    ) {
        $this->templating = $templating;
        $this->diverService = $diverService;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allAction(Request $request)
    {
        $divers = $this->diverService->getDivers();

        $data =  array(
            'divers' => $divers,
            'page' => 'AppBundle:diver:table.html.twig',
        );

        return $this->render($data);
    }

    /**
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAction($id)
    {
        $diver = $this->diverService->getDiver($id);
        $form = $this->formFactory->create(DiverType::class, $diver);

        $data =  array(
            'form' => $form->createView(),
        );

        return $this->templating->renderResponse("AppBundle:diver:add.html.twig", $data);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $diver = new Diver();
        $form = $this->formFactory->create(DiverType::class, $diver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->diverService->save($diver);

            $this->session->getFlashBag()->add('notice', 'Diver has been added successfully');

            return new RedirectResponse($this->router->generate('diver'));
        }
        $data =  array('form' => $form->createView());

        return $this->templating->renderResponse("AppBundle:diver:add.html.twig", $data);
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Diver $diver, Request $request)
    {
        $form = $this->formFactory->create(DiverType::class, $diver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->diverService->save($diver);
            $this->session->getFlashBag()->add('notice', 'Diver has been modified successfully');

            return new RedirectResponse($this->router->generate('diver'));
        }

        $data =  array('form' => $form->createView());

        return $this->templating->renderResponse("AppBundle:diver:add.html.twig", $data);
    }

    /**
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function render(array $data)
    {
        return $this->templating->renderResponse("AppBundle:diver:index.html.twig", $data);
    }
}
