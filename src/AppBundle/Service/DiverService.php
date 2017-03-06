<?php

namespace AppBundle\Service;

use AppBundle\Entity\Diver;
use AppBundle\Repository\DiverRepository;

/**
 * Diver service.
 */
class DiverService
{
    /** @var \AppBundle\Repository\DiverRepository */
    private $diverRepository;

    /**
     * DiverService constructor.
     *
     * @param \AppBundle\Repository\DiverRepository $diverRepository
     */
    public function __construct(DiverRepository $diverRepository)
    {
        $this->diverRepository = $diverRepository;
    }

    /**
     * @return \AppBundle\Entity\Diver[]
     */
    public function getDivers()
    {
        return $this->diverRepository->findAll();
    }

    /**
     * @param int $id
     *
     * @return \AppBundle\Entity\Diver
     */
    public function getDiver($id)
    {
        return $this->diverRepository->find($id);
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     */
    public function save(Diver $diver)
    {
        $this->diverRepository->save($diver);
    }
}
