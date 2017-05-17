<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FeeScale
 *
 * @ORM\Table(name="fee_scale")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FeeScaleRepository")
 */
class FeeScale
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
	 * One fee scale has many fees
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Fee", mappedBy="feeScale")
	 */
    private $fees;

	public function __construct() {
		$this->fees = new ArrayCollection();
    }

	/**
	 * @return mixed
	 */


    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;


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
     * @return FeeScale
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
     * Set user
     *
     * @param integer $userId
     *
     * @return FeeScale
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

	/**
	 * @return mixed
	 */
	public function getFees() {
		return $this->fees;
	}

	/**
	 * @param mixed $fees
	 * @return FeeScale
	 */
	public function setFees($fees) {
		$this->fees = $fees;
		return $this;
	}

    /**
     * Add fee
     *
     * @param \AppBundle\Entity\Fee $fee
     *
     * @return FeeScale
     */
    public function addFee(\AppBundle\Entity\Fee $fee)
    {
        $this->fees[] = $fee;

        return $this;
    }

    /**
     * Remove fee
     *
     * @param \AppBundle\Entity\Fee $fee
     */
    public function removeFee(\AppBundle\Entity\Fee $fee)
    {
        $this->fees->removeElement($fee);
    }
}
