<?php

namespace AppBundle\Service;

use AppBundle\Entity\Certificate;
use AppBundle\Repository\CertificateRepository;

/**
 * Certificate service.
 */
class CertificateService
{
    /** @var \AppBundle\Repository\CertificateRepository */
    private $certificateRepository;

    /**
     * @param \AppBundle\Repository\CertificateRepository $certificateRepository
     */
    public function __construct(CertificateRepository $certificateRepository)
    {
        $this->certificateRepository = $certificateRepository;
    }

    /**
     * @param \AppBundle\Entity\Certificate $certificate
     */
    public function remove(Certificate $certificate)
    {
        $this->certificateRepository->remove($certificate);
    }
}
