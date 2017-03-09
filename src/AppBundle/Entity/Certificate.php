<?php

namespace AppBundle\Entity;

use AppBundle\AppBundle;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="certificate")
 */
class Certificate
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Many Certificates have One diver.
     *
     * @ORM\ManyToOne(targetEntity="diver", inversedBy="certificates")
     *
     * @ORM\JoinColumn(name="diver_id", referencedColumnName="id")
     */
    private $diver;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Organisation")
     *
     * @ORM\JoinColumn(name="certifyingorganization_id", referencedColumnName="id")
     */
    private $certifyingOrganization;

    /** @ORM\Column(name="name", type="string", length=50, nullable=false) */
    private $name;

    /** @ORM\Column(name="registrationnumber", type="string", length=50, nullable=false) */
    private $registrationNumber;

    /** @ORM\Column(name="dateobtained", type="datetime", length=50, nullable=false) */
    private $dateObtained;

    /** @ORM\Column(name="instructorname", type="string", length=50, nullable=true) */
    private $instructorName;

    /** @ORM\Column(name="instructorregistrationnumber", type="string", length=50, nullable=true) */
    private $instructorRegistrationNumber;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiver()
    {
        return $this->diver;
    }

    /**
     * @param string $diver
     *
     * @return $this
     */
    public function setDiver($diver)
    {
        $this->diver = $diver;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\Organisation
     */
    public function getCertifyingOrganization()
    {
        return $this->certifyingOrganization;
    }

    /**
     * @param \AppBundle\Entity\Organisation $certifyingOrganization
     *
     * @return $this
     */
    public function setCertifyingOrganization($certifyingOrganization)
    {
        $this->certifyingOrganization = $certifyingOrganization;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getRegistrationNumber()
    {
        return $this->registrationNumber;
    }

    /**
     * @param string $registrationNumber
     *
     * @return $this
     */
    public function setRegistrationNumber($registrationNumber)
    {
        $this->registrationNumber = $registrationNumber;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateObtained()
    {
        return $this->dateObtained;
    }

    /**
     * @param \DateTime $dateObtained
     *
     * @return $this
     */
    public function setDateObtained(\DateTime $dateObtained)
    {
        $this->dateObtained = $dateObtained;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructorName()
    {
        return $this->instructorName;
    }

    /**
     * @param string $instructorName
     *
     * @return $this
     */
    public function setInstructorName($instructorName)
    {
        $this->instructorName = $instructorName;

        return $this;
    }

    /**
     * @return string
     */
    public function getInstructorRegistrationNumber()
    {
        return $this->instructorRegistrationNumber;
    }

    /**
     * @param string $instructorRegistrationNumber
     *
     * @return $this
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
                new Assert\NotBlank(array('message' => 'Required')),
            ));
    }
}
