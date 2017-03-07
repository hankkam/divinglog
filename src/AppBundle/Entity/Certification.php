<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Diver;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="certification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CertificationRepository")
 */
class Certification
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Many Certifications have One diver.
     *
     * @ManyToOne(targetEntity="diver", inversedBy="certifications")
     *
     * @JoinColumn(name="diver_id", referencedColumnName="id")
     */
    private $diver;

    /** @ORM\Column(name="certifyingorganization", type="string", length=50, nullable=false) */
    private $certifyingOrganization;

    /** @ORM\Column(name="certification", type="string", length=50, nullable=false) */
    private $certification;

    /** @ORM\Column(name="registrationnumber", type="string", length=50, nullable=false) */
    private $registrationNumber;

    /** @ORM\Column(name="dateobtained", type="datetime", length=50, nullable=false) */
    private $dateObtained;

    /** @ORM\Column(name="instructorname", type="string", length=50, nullable=true) */
    private $instructorName;

    /** @ORM\Column(name="instructorregistrationnumber", type="string", length=50, nullable=true) */
    private $instructorRegistrationNumber;

    /**
     * @return mixed
     */
    public function getDiver()
    {
        return $this->diver;
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     *
     * @return Certification
     */
    public function setDiver(Diver $diver)
    {
        $this->diver = $diver;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCertifyingOrganization()
    {
        return $this->certifyingOrganization;
    }

    /**
     * @param mixed $certifyingOrganization
     *
     * @return Certification
     */
    public function setCertifyingOrganization($certifyingOrganization)
    {
        $this->certifyingOrganization = $certifyingOrganization;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * @param mixed $certification
     *
     * @return Certification
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param mixed $registrationNumber
     *
     * @return Certification
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateObtained()
    {
        return $this->dateObtained;
    }

    /**
     * @param mixed $dateObtained
     *
     * @return Certification
     */
    public function setDateObtained($dateObtained)
    {
        $this->dateObtained = $dateObtained;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstructorName()
    {
        return $this->instructorName;
    }

    /**
     * @param mixed $instructorName
     *
     * @return Certification
     */
    public function setInstructorName($instructorName)
    {
        $this->instructorName = $instructorName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getInstructorRegistrationNumber()
    {
        return $this->instructorRegistrationNumber;
    }

    /**
     * @param mixed $instructorRegistrationNumber
     *
     * @return Certification
     */
    public function setInstructorRegistrationNumber($instructorRegistrationNumber)
    {
        $this->instructorRegistrationNumber = $instructorRegistrationNumber;

        return $this;
    }

    /**
     * Load validator metadata.
     *
     * @param \Symfony\Component\Validator\Mapping\ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata
            ->addPropertyConstraints('diver', array(
                new Assert\NotBlank(array('message' =>  'Required')),
            ))
        ;
    }
}
