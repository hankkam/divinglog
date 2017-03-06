<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="divercertification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiverCertificationRepository")
 */
class Certification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Many Certifications have One diver.
     *
     * @var \AppBundle\Entity\Diver
     *
     * @ManyToOne(targetEntity="diver", inversedBy="certifications")
     *
     * @JoinColumn(name="diver_id", referencedColumnName="id")
     */
    private $diver;

    /**
     * @var string
     *
     * @ORM\Column(name="certifyingorganization", type="string", length=50, nullable=false)
     */
    private $certifyingOrganization;

    /**
     * @var string
     *
     * @ORM\Column(name="certification", type="string", length=50, nullable=false)
     */
    private $certification;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=50, nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="dateObtained", type="datetime", length=50, nullable=false)
     */
    private $dateObtained;

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

