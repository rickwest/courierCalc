<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 15/05/17
 * Time: 19:26
 */

namespace AppBundle\Quote;


class QuoteCreator {
	
	const METRES_TO_MILES_CONVERSION = 0.000621371;
	
	public function convertMetresToMiles($metres) {
		return round($metres * self::METRES_TO_MILES_CONVERSION);
	}

	public function createQuote() {
	}
}