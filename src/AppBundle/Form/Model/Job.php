<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 16/05/17
 * Time: 22:08
 */

namespace AppBundle\Form\Model;


class Job {

    protected $userId;
	protected $start;
	protected $destination;
 	protected $via;
 	protected $feeScaleId;
 	protected $vehicleTypeId;
    protected $distance;
    protected $duration;

	/**
	 * @return mixed
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * @param mixed $start
	 * @return Job
	 */
	public function setStart($start) {
		$this->start = $start;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getDestination() {
		return $this->destination;
	}

	/**
	 * @param mixed $destination
	 * @return Job
	 */
	public function setDestination($destination) {
		$this->destination = $destination;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getVia() {
		return $this->via;
	}

	/**
	 * @param mixed $via
	 * @return Job
	 */
	public function setVia($via) {
		$this->via = $via;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getFeeScaleId() {
		return $this->feeScaleId;
	}

	/**
	 * @param mixed $feeScaleId
	 * @return Job
	 */
	public function setFeeScaleId($feeScaleId) {
		$this->feeScaleId = $feeScaleId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getVehicleTypeId() {
		return $this->vehicleTypeId;
	}

	/**
	 * @param mixed $vehicleTypeId
	 * @return Job
	 */
	public function setVehicleTypeId($vehicleTypeId) {
		$this->vehicleTypeId = $vehicleTypeId;
		return $this;
	}

    /**
     * @return mixed
     */
    public function getDistance() {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     * @return Job
     */
    public function setDistance($distance) {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDuration() {
        return $this->duration;
    }

    /**
     * @param mixed $duration
     * @return Job
     */
    public function setDuration($duration) {
        $this->duration = $duration;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     * @return Job
     */
    public function setUserId($userId) {
        $this->userId = $userId;
        return $this;
    }


}
