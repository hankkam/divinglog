<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Country;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="organisation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganisationRepository")
 */
class Organisation
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** @ORM\Column(name="abbreviation", type="string", length=30, nullable=false) */
    private $abbreviation;

    /** @ORM\Column(name="name", type="string", length=255, nullable=false) */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="country")
     *
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /** @ORM\Column(name="organisationtype", type="string", length=30, nullable=false) */
    private $organisationType;

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
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * @param string $abbreviation
     *
     * @return $this
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

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
     * @return \AppBundle\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param \AppBundle\Entity\Country
     *
     * @return $this
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganisationType()
    {
        return $this->organisationType;
    }

    /**
     * @param int $organisationType
     *
     * @return $this
     */
    public function setOrganisationType($organisationType)
    {
        $this->organisationType = $organisationType;

        return $this;
    }

    /**
     * Load validator metadata.
     *
     * @param \Symfony\Component\Validator\Mapping\ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
    }
}
