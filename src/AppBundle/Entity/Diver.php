<?php

namespace AppBundle\Entity;

use AppBundle\Entity\User;
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
     * @var integer
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
     * @ORM\Column(name="inserts", type="string", length=80, nullable=false)
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
     * @ORM\Column(name="streetname", type="string", length=50, nullable=false)
     */
    private $streetName;

    /**
     * @var string
     *
     * @ORM\Column(name="streetnumber", type="string", length=50, nullable=false)
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=50, nullable=false)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phonenumber", type="string", length=50, nullable=false)
     */
    private $phoneNumber;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
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
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getInserts()
    {
        return $this->inserts;
    }

    /**
     * @param string|null $inserts
     */
    public function setInserts($inserts)
    {
        $this->inserts = $inserts;
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
     */
    public function setInitials($initials)
    {
        $this->initials = $initials;
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
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
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
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * @param string $streetName
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
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
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
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
     */
    public function setCity($city)
    {
        $this->city = $city;
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
     */
    public function setCountry($country)
    {
        $this->country = $country;
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
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \AppBundle\Entity\User|null $user
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;
    }
    /**
     * Load validator metadata.
     *
     * @param \Symfony\Component\Validator\Mapping\ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata
            ->addPropertyConstraints('firstName', array(
                new Assert\NotBlank(array('message' =>  'Required')),
                new Assert\Regex(array(
                    'pattern'     => '/^[a-z]+$/i',
                    'htmlPattern' => '^[a-zA-Z]+$',
                    'message' => 'Invalid characters.'
                )),
            ))
            ->addPropertyConstraints('initials', array(
                new Assert\NotBlank(array('message' =>  'Required')),
            ))
            ->addPropertyConstraints('lastName', array(
                new Assert\NotBlank(array('message' =>  'Required')),
            ))
            ->addPropertyConstraints('dateOfBirth', array(
                new Assert\Date(array('message' => 'Invalid date')),
            ))
            ->addPropertyConstraints('gender', array(
                new Assert\NotNull(),
            ))
            ->addPropertyConstraints('user', array(
                new Assert\NotNull(),
            ))
        ;
    }
}

