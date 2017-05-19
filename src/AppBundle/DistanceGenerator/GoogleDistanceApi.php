<?php

namespace AppBundle\DistanceGenerator;

use AppBundle\Entity\Location;
use GuzzleHttp\Client;

class GoogleDistanceApi implements DistanceGeneratorInterface {

	private $googleApiKey;

	public function __construct($googleApiKey) {
		$this->googleApiKey = $googleApiKey;
	}

	public function getDistance(Location $origin, Location $destination, Location $via = null) {

		$client = new Client();

		$url  = 'https://maps.googleapis.com/maps/api/directions/json?';
		$url .= 'origin=' . $origin->getName();
		$url .= '&destination=' . $destination->getName();

		if (!empty($via)) {
            $url .= '&waypoints=' . $via->getName();
        }

		$url .= '&units=imperial';
		$url .= '&mode=driving';
		$url .= '&key=' . $this->googleApiKey;

        $res = $client->get($url);
        $directions = json_decode($res->getBody()->getContents(), true);

		// there should always only be one route but we are passed an array.
		$route = [];
		foreach ($directions['routes'] as $route) {
			foreach ($route['legs'] as $leg) {
				$route = $leg;
				//because we are only handling one leg at the minute
				//needs sorting for when we are handling multiple legs
			}
		}

        $distance = $route['distance']['value'];
        $duration = $route['duration']['text'];

		return [$distance, $duration];
	}
}