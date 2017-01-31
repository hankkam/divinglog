<?php

namespace AppBundle\Service;

use AppBundle\Entity\Member;
use AppBundle\Repository\MemberRepository;

/**
 * Member service.
 */
class MemberService
{
    /** @var \AppBundle\Repository\MemberRepository */
    private $memberRepository;

    /**
     * MemberService constructor.
     *
     * @param \AppBundle\Repository\MemberRepository $memberRepository
     */
    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @return \AppBundle\Entity\Member[]
     */
    public function getMembers()
    {
        return $this->memberRepository->findAll();
    }

    /**
     * @param int $id
     *
     * @return \AppBundle\Entity\Member
     */
    public function getMember($id)
    {
        return $this->memberRepository->find($id);
    }

    /**
     * @param \AppBundle\Entity\Member $member
     */
    public function save(Member $member)
    {
        $this->memberRepository->save($member);
    }
}
