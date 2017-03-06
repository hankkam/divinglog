<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Diver;
use Doctrine\ORM\EntityRepository;

/**
 * Diver repository.
 */
class DiverRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\Diver $diver
     */
    public function save(Diver $diver)
    {
        $em = $this->getEntityManager();
        $em->persist($diver);
        $em->flush();
    }
}
