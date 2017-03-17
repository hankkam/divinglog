<?php

namespace AppBundle\Service;

use AppBundle\Repository\DiveLogRepository;

/**
 * Diver service.
 */
class DiveLogService
{
    /** @var \AppBundle\Repository\DiveLogRepository */
    private $diveLogRepository;

    /**
     * DiveLogService constructor.
     *
     * @param \AppBundle\Repository\DiveLogRepository $diveLogRepository
     */
    public function __construct(DiveLogRepository $diveLogRepository)
    {
        $this->diveLogRepository = $diveLogRepository;
    }

    public function findByDiver($diverId)
    {
        $this->diveLogRepository->findBy(array('diver_id' => $diverId));
    }
}
