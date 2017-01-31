<?php

namespace AppBundle\Service;

use AppBundle\Entity\User;
use AppBundle\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Registration service.
 */
class RegistrationService
{
    /** @var \AppBundle\Repository\UserRepository */
    private $userRepository;

    /** @var \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface */
    private $encoderFactory;

    /**
     * @param \AppBundle\Repository\UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->userRepository = $userRepository;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param \AppBundle\Entity\User $user
     */
    public function register(User $user)
    {
        $encoder = $this->encoderFactory->getEncoder($user);
        $password = $encoder->encodePassword(
            $user->getEmail(),
            $user->getPlainPassword()
        );
        $user->setPassword($password);
        $user->setLastOnline(new \DateTime());
        $user->setExpires(new \DateTime('3000-12-31'));
        $user->setIsActive(false);

        $this->userRepository->save($user);
    }
}
