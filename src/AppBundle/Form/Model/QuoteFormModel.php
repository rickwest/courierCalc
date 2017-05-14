<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 31/03/2017
 * Time: 21:40
 */

namespace AppBundle\Form\Model;


class QuoteFormModel {

	protected $start;
	protected $destination;
	protected $via;
	protected $feeScaleId;
	protected $vehicleTypeId;

	/**
	 * @return mixed
	 */
	public function getStart() {
		return $this->start;
	}

	/**
	 * @param mixed $start
	 * @return QuoteFormModel
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
	 * @return QuoteFormModel
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
	 * @return QuoteFormModel
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
	 * @return QuoteFormModel
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
	 * @return QuoteFormModel
	 */
	public function setVehicleTypeId($vehicleTypeId) {
		$this->vehicleTypeId = $vehicleTypeId;
		return $this;
	}
}