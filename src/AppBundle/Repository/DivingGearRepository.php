<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Gear;
use Doctrine\ORM\EntityRepository;

/**
 * Diving gear repository.
 */
class DivingGearRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\Gear $gear
     */
    public function remove(Gear $gear)
    {
        $em = $this->getEntityManager();
        $em->persist($gear);
        $em->remove($gear);
        $em->flush($gear);
    }
}
