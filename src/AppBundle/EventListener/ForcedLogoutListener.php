<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;


class ForcedLogoutListener
{
    /** @var  \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface */
    protected $tokenStorage;

    /** @var  AuthorizationCheckerInterface */
    protected $authChecker;

    /** @var  SessionInterface */
    protected $session;

    /** @var  RouterInterface */
    protected $router;

    /** @var  \Doctrine\ORM\EntityRepository */
    protected $userRepository;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authChecker
     * @param SessionInterface $session
     * @param RouterInterface $router
     * @param \Doctrine\ORM\EntityRepository $userRepository
     */
    public function __construct(
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authChecker,
        SessionInterface $session,
        RouterInterface $router,
        EntityRepository $userRepository
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->authChecker = $authChecker;
        $this->session = $session;
        $this->router = $router;
        $this->userRepository = $userRepository;
    }

    /**
     * @param GetResponseEvent $event
     *
     * @return RedirectResponse|void
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest() || !$this->isUserLoggedIn()) {
            return;
        }

        $accessToken = $this->tokenStorage->getToken();

        /** @var User $user */
        $user = $accessToken->getUser();

        // Forcing user to log out if required.
        if ($user->isForceLogout()) {

            // Logging user out.
            $response = $this->getRedirectResponse('app.login');
            $this->logUserOut($response);

            // Saving the user.
            $user->setForceLogout(false);
            $this->userRepository->save($user);

            // Setting redirect response.
            $event->setResponse($response);
        }
    }

    protected function isUserLoggedIn()
    {
        try {
            return $this->authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED');
        } catch (AuthenticationCredentialsNotFoundException $exception) {
            // Ignoring this exception.
        }

        return false;
    }

    /**
     * @param string $routeName
     *
     * @return RedirectResponse
     */
    protected function getRedirectResponse($routeName)
    {
        return new RedirectResponse(
            $this->router->generate($routeName)
        );
    }

    /**
     * @param Response $response
     */
    protected function logUserOut(Response $response = null)
    {
        // Logging user out.
        $this->tokenStorage->setToken(null);

        // Invalidating the session.
        $this->session->invalidate();

        // Clearing the cookies.
//        if (null !== $response) {
//            foreach ([
//                         $this->sessionName,
//                         $this->rememberMeSessionName,
//                     ] as $cookieName) {
//                $response->headers->clearCookie($cookieName);
//            }
//        }
    }
}