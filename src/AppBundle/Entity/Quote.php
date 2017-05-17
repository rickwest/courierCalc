<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quote
 *
 * @ORM\Table(name="quote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuoteRepository")
 */
class Quote {

	//vehicle types
	const VEHICLE_TYPE_SMALL_VAN = 1;
	const VEHICLE_TYPE_SWB = 2;
	const VEHICLE_TYPE_LWB = 3;
	const VEHICLE_TYPE_LUTON = 4;
	const VEHICLE_TYPE_ARCTIC = 5;
	const VEHICLE_TYPE_SPECIAL = 6;

	//fee types
	const FEE_TYPE_PER_MILE = 1;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="user_id", type="integer", unique=false)
	 */
	private $userId;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Location", cascade={"all"})
	 */
	private $start;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Location", cascade={"all"})
	 */
	private $via;

	/**
	 * @ORM\OneToOne(targetEntity="AppBundle\Entity\Location", cascade={"all"})
	 */
	private $destination;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="fee_scale_id", type="integer", unique=false)
	 */
	private $feeScaleId;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="vehicle_type_id", type="integer", unique=false)
	 */
	private $vehicleTypeId;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="distance", type="float")
	 */
	private $distance;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="duration", type="string", length=255, unique=false)
	 */
	private $duration;


	/**
	 * @var float
	 *
	 * @ORM\Column(name="price", type="float", unique=false)
	 */
	private $price;

	/**
	 * @var float
	 *
	 * @ORM\Column(name="cost", type="float", unique=false)
	 */
	private $cost;

	

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Quote
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set feeScaleId
     *
     * @param integer $feeScaleId
     *
     * @return Quote
     */
    public function setFeeScaleId($feeScaleId)
    {
        $this->feeScaleId = $feeScaleId;

        return $this;
    }

    /**
     * Get feeScaleId
     *
     * @return integer
     */
    public function getFeeScaleId()
    {
        return $this->feeScaleId;
    }

    /**
     * Set vehicleTypeId
     *
     * @param integer $vehicleTypeId
     *
     * @return Quote
     */
    public function setVehicleTypeId($vehicleTypeId)
    {
        $this->vehicleTypeId = $vehicleTypeId;

        return $this;
    }

    /**
     * Get vehicleTypeId
     *
     * @return integer
     */
    public function getVehicleTypeId()
    {
        return $this->vehicleTypeId;
    }

    /**
     * Set distance
     *
     * @param string $distance
     *
     * @return Quote
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;

        return $this;
    }

    /**
     * Get distance
     *
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * Set duration
     *
     * @param float $duration
     *
     * @return Quote
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return float
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Quote
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set cost
     *
     * @param float $cost
     *
     * @return Quote
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set start
     *
     * @param \AppBundle\Entity\Location $start
     *
     * @return Quote
     */
    public function setStart(\AppBundle\Entity\Location $start = null)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \AppBundle\Entity\Location
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set via
     *
     * @param \AppBundle\Entity\Location $via
     *
     * @return Quote
     */
    public function setVia(\AppBundle\Entity\Location $via = null)
    {
        $this->via = $via;

        return $this;
    }

    /**
     * Get via
     *
     * @return \AppBundle\Entity\Location
     */
    public function getVia()
    {
        return $this->via;
    }

    /**
     * Set destination
     *
     * @param \AppBundle\Entity\Location $destination
     *
     * @return Quote
     */
    public function setDestination(\AppBundle\Entity\Location $destination = null)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return \AppBundle\Entity\Location
     */
    public function getDestination()
    {
        return $this->destination;
    }
}
