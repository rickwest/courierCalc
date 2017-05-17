<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fee
 *
 * @ORM\Table(name="fee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeeRepository")
 */
class Fee
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
	 * Many fees have one fee scale
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FeeScale", inversedBy="fees")
	 */
    private $feeScale;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="fee_type_id", type="integer")
	 */
	private $feeTypeId;

    /**
     * @var int
     *
     * @ORM\Column(name="vehicle_type_id", type="integer")
     */
    private $vehicleTypeId;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", options={"default" : 0})
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", options={"default" : 0})
     */
    private $cost;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Fee
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set vehicleTypeId
     *
     * @param integer $vehicleTypeId
     *
     * @return Fee
     */
    public function setVehicleTypeId($vehicleTypeId)
    {
        $this->vehicleTypeId = $vehicleTypeId;

        return $this;
    }

    /**
     * Get vehicleTypeId
     *
     * @return int
     */
    public function getVehicleTypeId()
    {
        return $this->vehicleTypeId;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Fee
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
     * @return Fee
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
	 * @return int
	 */
	public function getFeeTypeId(): int {
		return $this->feeTypeId;
	}

	/**
	 * @param int $feeTypeId
	 * @return Fee
	 */
	public function setFeeTypeId(int $feeTypeId): Fee {
		$this->feeTypeId = $feeTypeId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFeeScale() {
		return $this->feeScale;
	}

	/**
	 * @param mixed $feeScale
	 * @return Fee
	 */
	public function setFeeScale($feeScale) {
		$this->feeScale = $feeScale;
		return $this;
	}
}
