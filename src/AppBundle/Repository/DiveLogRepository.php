<?php

namespace AppBundle\Repository;

use AppBundle\Entity\DiveLog;
use Doctrine\ORM\EntityRepository;

/**
 * Dive log repository.
 */
class DiveLogRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\DiveLog $diveLog
     */
    public function save(DiveLog $diveLog)
    {
        $em = $this->getEntityManager();;
        $em->persist($diveLog);
        $em->flush($diveLog);
    }
}
