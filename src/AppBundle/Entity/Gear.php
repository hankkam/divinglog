<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Diver;
use AppBundle\Entity\GearType;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DivingGearRepository")
 * @ORM\Table(name="divinggear")
 */
class Gear
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Many diving gear have One diver.
     *
     * @var \AppBundle\Entity\Diver
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Diver", inversedBy="equipment")
     * @ORM\JoinColumn(name="diver_id", referencedColumnName="id", nullable=false)
     */
    private $diver;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GearType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=50, nullable=false)
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column(name="brandtype", type="string", length=50, nullable=false)
     */
    private $brandType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

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
     * @return \AppBundle\Entity\Diver
     */
    public function getDiver()
    {
        return $this->diver;
    }

    /**
     * @param \AppBundle\Entity\Diver $diver
     *
     * @return $this
     */
    public function setDiver(Diver $diver)
    {
        $this->diver = $diver;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\GearType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param \AppBundle\Entity\GearType $type
     *
     * @return $this
     */
    public function setType(GearType $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     *
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return string
     */
    public function getBrandType()
    {
        return $this->brandType;
    }

    /**
     * @param string $brandType
     *
     * @return $this
     */
    public function setBrandType($brandType)
    {
        $this->brandType = $brandType;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
            ->addPropertyConstraints('type', array(
                new Assert\NotNull(array('message' => 'Required')),
                new Assert\NotBlank(array('message' => 'Required')),
            ))
            ->addPropertyConstraints('brand', array(
                new Assert\NotBlank(array('message' => 'Required')),
            ))
        ;
    }
}
