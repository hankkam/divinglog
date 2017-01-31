<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Member;
use Doctrine\ORM\EntityRepository;

/**
 * Member repository.
 */
class MemberRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\Member $member
     */
    public function save(Member $member)
    {
        $em = $this->getEntityManager();
        $em->persist($member);
        $em->flush();
    }
}
