<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="divelog")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DiveLogRepository")
 */
class DiveLog
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
     * Many Certificates have One diver.
     *
     * @var \AppBundle\Entity\Diver
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Diver", inversedBy="divelogs")
     * @ORM\JoinColumn(name="diver_id", referencedColumnName="id", nullable=false)
     */
    private $diver;

    /**
     * @var int
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=2, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=50, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="divesite", type="string", length=50, nullable=false)
     */
    private $diveSite;

    /**
     * @var int
     *
     * @ORM\Column(name="airtemperature", type="integer", nullable=false)
     */
    private $airTemperature;

    /**
     * @var int
     *
     * @ORM\Column(name="watertemperature", type="integer", nullable=false)
     */
    private $waterTemperature;

    /**
     * @var int
     *
     * @ORM\Column(name="altitude", type="integer", nullable=false)
     */
    private $altitude;

    /**
     * @var int
     *
     * @ORM\Column(name="visibility", type="integer", nullable=false)
     */
    private $visibility;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timein", type="datetime", nullable=false)
     */
    private $timeIn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeout", type="datetime", nullable=false)
     */
    private $timeOut;

    /**
     * @var int
     *
     * @ORM\Column(name="airpressurestart", type="integer", nullable=false)
     */
    private $airPressureStart;

    /**
     * @var int
     *
     * @ORM\Column(name="airpressureend", type="integer", nullable=false)
     */
    private $airPressureEnd;

    /**
     * @var
     *
     * @ORM\Column(name="tank", type="string", columnDefinition="enum('aluminium', 'steel')", nullable=false)
     */
    private $tank;

    /**
     * @var string
     *
     * @ORM\Column(name="tanksize", type="string", columnDefinition="enum('5', '10', '12', '15', 'unknown')", nullable=false)
     */
    private $tankSize;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

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
     * @return DiveLog
     */
    public function setDiver($diver)
    {
        $this->diver = $diver;
        return $this;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     *
     * @return $this
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return string
     */
    public function getDiveSite()
    {
        return $this->diveSite;
    }

    /**
     * @param string $diveSite
     *
     * @return $this
     */
    public function setDiveSite($diveSite)
    {
        $this->diveSite = $diveSite;

        return $this;
    }

    /**
     * @return int
     */
    public function getAirTemperature()
    {
        return $this->airTemperature;
    }

    /**
     * @param int $airTemperature
     *
     * @return $this
     */
    public function setAirTemperature($airTemperature)
    {
        $this->airTemperature = $airTemperature;

        return $this;
    }

    /**
     * @return int
     */
    public function getWaterTemperature()
    {
        return $this->waterTemperature;
    }

    /**
     * @param int $waterTemperature
     *
     * @return $this
     */
    public function setWaterTemperature($waterTemperature)
    {
        $this->waterTemperature = $waterTemperature;

        return $this;
    }

    /**
     * @return int
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @param int $altitude
     * @return $this
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;

        return $this;
    }

    /**
     * @return int
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @param int $visibility
     *
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeIn()
    {
        return $this->timeIn;
    }

    /**
     * @param \DateTime $timeIn
     *
     * @return $this
     */
    public function setTimeIn($timeIn)
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getTimeOut()
    {
        return $this->timeOut;
    }

    /**
     * @param \DateTime $timeOut
     *
     * @return $this
     */
    public function setTimeOut($timeOut)
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    /**
     * @return int
     */
    public function getAirPressureStart()
    {
        return $this->airPressureStart;
    }

    /**
     * @param int $airPressureStart
     *
     * @return $this
     */
    public function setAirPressureStart($airPressureStart)
    {
        $this->airPressureStart = $airPressureStart;

        return $this;
    }

    /**
     * @return int
     */
    public function getAirPressureEnd()
    {
        return $this->airPressureEnd;
    }

    /**
     * @param int $airPressureEnd
     *
     * @return $this
     */
    public function setAirPressureEnd($airPressureEnd)
    {
        $this->airPressureEnd = $airPressureEnd;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTank()
    {
        return $this->tank;
    }

    /**
     * @param mixed $tank
     *
     * @return $this
     */
    public function setTank($tank)
    {
        $this->tank = $tank;

        return $this;
    }

    /**
     * @return string
     */
    public function getTankSize()
    {
        return $this->tankSize;
    }

    /**
     * @param string $tankSize
     *
     * @return $this
     */
    public function setTankSize($tankSize)
    {
        $this->tankSize = $tankSize;

        return $this;
    }

    /**
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     *
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
}
