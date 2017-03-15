<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Specialty;
use Doctrine\ORM\EntityRepository;

/**
 * Specialty repository.
 */
class SpecialtyRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\Specialty $specialty
     */
    public function remove(Specialty $specialty)
    {
        $em = $this->getEntityManager();
        $em->persist($specialty);
        $em->remove($specialty);
        $em->flush($specialty);
    }
}
