<?php

namespace AppBundle\Service;

use AppBundle\Entity\Specialty;
use AppBundle\Repository\SpecialtyRepository;

/**
 * Specialty service.
 */
class SpecialtyService
{
    /** @var \AppBundle\Repository\SpecialtyRepository */
    private $specialtyRepository;

    /**
     * @param \AppBundle\Repository\SpecialtyRepository $specialtyRepository
     */
    public function __construct(SpecialtyRepository $specialtyRepository)
    {
        $this->specialtyRepository = $specialtyRepository;
    }

    /**
     * @param \AppBundle\Entity\Specialty $specialty
     */
    public function remove(Specialty $specialty)
    {
        $this->specialtyRepository->remove($specialty);
    }
}
