<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 14/05/17
 * Time: 23:28
 */

namespace AppBundle\Form\ChoiceHelper;


class ChoiceHelper {

	//vehicleTypes
	const VEHICLE_TYPE_SMALL_VAN = 1;
	const VEHICLE_TYPE_SWB = 2;
	const VEHICLE_TYPE_LWB = 3;
	const VEHICLE_TYPE_LUTON = 4;
	const VEHICLE_TYPE_ARCTIC = 5;
	const VEHICLE_TYPE_SPECIAL = 6;

	public static function getVehicleTypeChoices() {
		return [
			'Small Van' => self::VEHICLE_TYPE_SMALL_VAN,
			'SWB Van' => self::VEHICLE_TYPE_SWB,
			'LWB Van' => self::VEHICLE_TYPE_LWB,
			'Luton' => self::VEHICLE_TYPE_LUTON,
			'Arctic' => self::VEHICLE_TYPE_ARCTIC,
			'Special' => self::VEHICLE_TYPE_SPECIAL,
		];
	}

	public static function getFeeScaleChoices() {
		return [];
	}
}