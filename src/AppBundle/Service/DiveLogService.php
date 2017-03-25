<?php

namespace AppBundle\Service;

use AppBundle\Entity\DiveLog;
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

    /**
     * @param \AppBundle\Entity\DiveLog $diveLog
     */
    public function save(DiveLog $diveLog)
    {
        $this->diveLogRepository->save($diveLog);
    }
}
