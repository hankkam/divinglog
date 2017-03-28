<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DiveLog;
use AppBundle\Entity\Diver;
use AppBundle\Form\DiveLogType;
use AppBundle\Service\DiveLogService;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
            'diver_id' => $diver->getId(),
        );

        return $this->render($data);
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Diver $diver, Request $request)
    {
        // Create an ArrayCollection of the current dive logs objects in the database
        $originalDiveLogs = new ArrayCollection();
        foreach ($diver->getDiveLogs() as $diveLog) {
            $originalDiveLogs->add($diveLog);
        }

        $diveLog = new DiveLog();
        $diveLog->setDiver($diver);
        $diveLog->setNumber($originalDiveLogs->count()+1);


        $form = $this->formFactory->create(DiveLogType::class, $diveLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->diveLogService->save($diveLog);

            $this->session->getFlashBag()->add('notice', 'Dive log has been added successfully');

            return new RedirectResponse($this->router->generate('dive_log_list'));
        }

        $data =  array('form' => $form->createView(), 'fullname' => $diver->getFullName(), 'diver_id' => $diver->getId());

        return $this->templating->renderResponse("AppBundle:divelogs:add.html.twig", $data);
    }

    /**
     * @param \AppBundle\Entity\DiveLog $diveLog
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(DiveLog $diveLog, Request $request)
    {
        $form = $this->formFactory->create(DiveLogType::class, $diveLog);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->diveLogService->save($diveLog);

            $this->session->getFlashBag()->add('notice', 'Dive log has been updated successfully');

            return new RedirectResponse($this->router->generate('dive_log_list', array('id' => $diveLog->getDiver()->getId())));
        }

        $data =  array('form' => $form->createView(), 'fullname' => $diveLog->getDiver()->getFullName(), 'diver_id' => $diveLog->getDiver()->getId());

        return $this->templating->renderResponse("AppBundle:divelogs:add.html.twig", $data);
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
