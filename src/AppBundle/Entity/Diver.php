<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * @ORM\Table(name="diver")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiverRepository")
 */
class Diver
{
    /**
     * @var int;
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=80, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=80, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="inserts", type="string", length=80, nullable=true)
     */
    private $inserts;

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=80, nullable=false)
     */
    private $initials;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateofbirth", type="datetime", nullable=false)
     */
    private $dateOfBirth;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=false)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=50, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=true)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=50, nullable=true)
     */
    private $phoneNumber;

    /**
     * One diver has Many certificates.
     *
     * @var \AppBundle\Entity\Certificate[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Certificate", mappedBy="diver", cascade={"persist", "remove"})
     */
    private $certificates;

    /**
     * One diver has Many specialties.
     *
     * @var \AppBundle\Entity\Specialty[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Specialty", mappedBy="diver", cascade={"persist", "remove"})
     */
    private $specialties;

    /**
     * One diver has Many diving gear.
     *
     * @var \AppBundle\Entity\Gear[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Gear", mappedBy="diver", cascade={"persist", "remove"})
     */
    private $equipment;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->certificates = new ArrayCollection();
        $this->specialties = new ArrayCollection();
        $this->equipment = new ArrayCollection();
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
     * @return string
     */
    public function getFullName()
    {
        $fullName = '';
        $fullName .= $this->getFirstName();
        if (!empty($this->getInserts())){
            $fullName .= ' ' . $this->getInserts();
        }
        $fullName .= ' ' . $this->getLastName();

        return trim($fullName);
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
     * @return \AppBundle\Entity\Certificate[]
     */
    public function getCertificates()
    {
        return $this->certificates;
    }

    /**
     * @param \AppBundle\Entity\Certificate $certificate
     */
    public function addCertificate(Certificate $certificate)
    {
        $certificate->setDiver($this);

        $this->certificates->add($certificate);
    }

    /**
     * @param \AppBundle\Entity\Certificate $certificate
     */
    public function removeCertificate(Certificate $certificate)
    {
        $this->certificates->removeElement($certificate);
    }

    /**
     * @return \AppBundle\Entity\Specialty[]
     */
    public function getSpecialties()
    {
        return $this->specialties;
    }

    /**
     * @param \AppBundle\Entity\Specialty $specialty
     */
    public function addSpecialty(Specialty $specialty)
    {
        $specialty->setDiver($this);

        $this->specialties->add($specialty);
    }

    /**
     * @param \AppBundle\Entity\Specialty $specialty
     */
    public function removeSpecialty(Specialty $specialty)
    {
        $this->specialties->removeElement($specialty);
    }

    /**
     * @return \AppBundle\Entity\Gear[]
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * @param \AppBundle\Entity\Gear $gear
     */
    public function addEquipment(Gear $gear)
    {
        $gear->setDiver($this);

        $this->equipment->add($gear);
    }

    /**
     * @param \AppBundle\Entity\Gear $gear
     */
    public function removeEquipment(Gear $gear)
    {
        $this->equipment->removeElement($gear);
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
            ))
            ->addPropertyConstraints('specialties', array(
                new Assert\Valid(),
            ))
            ->addPropertyConstraints('equipment', array(
                new Assert\Valid(),
            ))
        ;
    }
}
