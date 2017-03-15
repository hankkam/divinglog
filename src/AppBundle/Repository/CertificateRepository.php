<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Certificate;
use Doctrine\ORM\EntityRepository;

/**
 * Certificate repository.
 */
class CertificateRepository extends EntityRepository
{
    /**
     * @param \AppBundle\Entity\Certificate $certificate
     */
    public function remove(Certificate $certificate)
    {
        $em = $this->getEntityManager();
        $em->persist($certificate);
        $em->remove($certificate);
        $em->flush($certificate);
    }
}
