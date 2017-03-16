<?php

namespace AppBundle\Service;

use AppBundle\Entity\Gear;
use AppBundle\Repository\DivingGearRepository;

/**
 * Equipment service.
 */
class EquipmentService
{
    /** @var \AppBundle\Repository\DivingGearRepository */
    private $divingGearRepository;

    /**
     * @param \AppBundle\Repository\DivingGearRepository $divingGearRepository
     */
    public function __construct(DivingGearRepository $divingGearRepository)
    {
        $this->divingGearRepository = $divingGearRepository;
    }

    /**
     * @param \AppBundle\Entity\Gear $gear
     */
    public function remove(Gear $gear)
    {
        $this->divingGearRepository->remove($gear);
    }
}
