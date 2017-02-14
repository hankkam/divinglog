<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * User repository.
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $username
     *
     * @return mixed
     */
    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username OR u.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

//    /**
//     * @param \AppBundle\Entity\User $user
//     */
//    public function save(User $user)
//    {
//        $em = $this->getEntityManager();
//        $em->persist($user);
//        $em->flush();
//    }
}
