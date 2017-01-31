<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\RegisterType;
use AppBundle\Service\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Registration controller.
 */
class RegistrationController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \AppBundle\Service\RegistrationService */
    private $registrationService;

    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \AppBundle\Service\RegistrationService $registrationService
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    public function __construct(
        EngineInterface $templating,
        RegistrationService $registrationService,
        FormFactoryInterface $formFactory,
        Session $session,
        Router $router
    ) {
        $this->templating = $templating;
        $this->registrationService = $registrationService;
        $this->formFactory = $formFactory;
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->formFactory->create(RegisterType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->registrationService->register($user);

            $this->session->getFlashBag()->add('notice', 'Member has been added successfully');

            return new RedirectResponse($this->router->generate('member'));
        }
        $data =  array('form' => $form->createView());

        return $this->templating->renderResponse("AppBundle:security:register.html.twig", $data);
    }
}
