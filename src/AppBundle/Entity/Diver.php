<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Entity
 * @ORM\Table(name="diver")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiverRepository")
 */
class Diver
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /** @ORM\Column(name="firstname", type="string", length=80, nullable=false) */
    private $firstName;

    /** @ORM\Column(name="lastname", type="string", length=80, nullable=false) */
    private $lastName;

    /** @ORM\Column(name="inserts", type="string", length=80, nullable=true) */
    private $inserts;

    /** @ORM\Column(name="initials", type="string", length=80, nullable=false) */
    private $initials;

    /** @ORM\Column(name="dateofbirth", type="datetime", nullable=false) */
    private $dateOfBirth;

    /** @ORM\Column(name="gender", type="string", nullable=false) */
    private $gender;

    /** @ORM\Column(name="street", type="string", length=50, nullable=true) */
    private $street;

    /** @ORM\Column(name="postalcode", type="string", length=50, nullable=true) */
    private $postalCode;

    /** @ORM\Column(name="city", type="string", length=50, nullable=true) */
    private $city;

    /** @ORM\Column(name="country", type="string", length=2, nullable=true) */
    private $country;

    /** @ORM\Column(name="phonenumber", type="string", length=50, nullable=true) */
    private $phoneNumber;

    /**
     * One diver has Many certificates.
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Certificate", mappedBy="diver", cascade={"persist", "remove"})
     */
    private $certificates;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->certificates = new ArrayCollection();
    }

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
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getInserts()
    {
        return $this->inserts;
    }

    /**
     * @param string $inserts
     *
     * @return $this
     */
    public function setInserts($inserts)
    {
        $this->inserts = $inserts;

        return $this;
    }

    /**
     * @return string
     */
    public function getInitials()
    {
        return $this->initials;
    }

    /**
     * @param string $initials
     *
     * @return $this
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @param \DateTime $dateOfBirth
     *
     * @return $this
     */
    public function setDateOfBirth(\DateTime $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     *
     * @return $this
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     *
     * @return $this
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return string
     */
    public function getCertificates()
    {
        return $this->certificates;
    }

    public function addCertificate(Certificate $certificate)
    {
        $certificate->setDiver($this);

        $this->certificates->add($certificate);
    }

    public function removeCertificate(Certificate $certificate)
    {
        $this->certificates->removeElement($certificate);
    }

    /**
     * Load validator metadata.
     *
     * @param \Symfony\Component\Validator\Mapping\ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata
            ->addPropertyConstraints('initials', array(
                new Assert\NotBlank(array('message' => 'Required')),
            ))
            ->addPropertyConstraints('firstName', array(
                new Assert\NotBlank(array('message' => 'Required')),
                new Assert\Regex(array(
                    'pattern' => '/^[a-z]+$/i',
                    'htmlPattern' => '^[a-zA-Z]+$',
                    'message' => 'Invalid characters.'
                )),
            ))
            ->addPropertyConstraints('lastName', array(
                new Assert\NotBlank(array('message' => 'Required')),
            ))
            ->addPropertyConstraints('dateOfBirth', array(
                new Assert\Date(array('message' => 'Invalid date')),
            ))
            ->addPropertyConstraints('gender', array(
                new Assert\NotNull(),
            ))
            ->addPropertyConstraints('certificates', array(
                new Assert\Valid(),
            ));
    }
}
