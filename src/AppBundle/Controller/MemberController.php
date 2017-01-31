<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Member;
use AppBundle\Form\MemberType;
use AppBundle\Service\MemberService;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Member controller.
 */
class MemberController
{
    /** @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface */
    private $templating;

    /** @var \AppBundle\Service\MemberService */
    private $memberService;

    /** @var \Symfony\Component\Form\FormFactoryInterface */
    private $formFactory;

    /** @var \Symfony\Component\HttpFoundation\Session\Session */
    private $session;

    /** @var \Symfony\Bundle\FrameworkBundle\Routing\Router */
    private $router;

    /**
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \AppBundle\Service\MemberService $memberService
     * @param \Symfony\Component\Form\FormFactoryInterface $formFactory
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @param \Symfony\Bundle\FrameworkBundle\Routing\Router $router
     */
    public function __construct(
        EngineInterface $templating,
        MemberService $memberService,
        FormFactoryInterface $formFactory,
        Session $session,
        Router $router
    ) {
        $this->templating = $templating;
        $this->memberService = $memberService;
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
        $members = $this->memberService->getMembers();

        $data =  array(
            'members' => $members,
            'page' => 'AppBundle:member:table.html.twig',
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
        $member = $this->memberService->getMember($id);
        $form = $this->formFactory->create(MemberType::class, $member);

        $data =  array(
            'form' => $form->createView(),
        );

        return $this->templating->renderResponse("AppBundle:member:add.html.twig", $data);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addAction(Request $request)
    {
        $member = new Member();
        $form = $this->formFactory->create(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->memberService->save($member);

            $this->session->getFlashBag()->add('notice', 'Member has been added successfully');

            return new RedirectResponse($this->router->generate('member'));
        }
        $data =  array('form' => $form->createView());

        return $this->templating->renderResponse("AppBundle:member:add.html.twig", $data);
    }

    /**
     * @param \AppBundle\Entity\Member $member
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|
     *         \Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Member $member, Request $request)
    {
        $form = $this->formFactory->create(MemberType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->memberService->save($member);
            $this->session->getFlashBag()->add('notice', 'Member has been modified successfully');

            return new RedirectResponse($this->router->generate('member'));
        }

        $data =  array('form' => $form->createView());

        return $this->templating->renderResponse("AppBundle:member:add.html.twig", $data);
    }

    /**
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function render(array $data)
    {
        return $this->templating->renderResponse("AppBundle:member:index.html.twig", $data);
    }
}
