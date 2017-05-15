<?php
/**
 * Created by PhpStorm.
 * User: rick
 * Date: 15/05/17
 * Time: 19:29
 */

namespace AppBundle\DistanceGenerator;


use GuzzleHttp\Client;

class GoogleDistanceApi {

	private $googleApiKey;

	public function __construct($googleApiKey) {
		$this->googleApiKey = $googleApiKey;
	}

	public function getDirections($origin, $destination, $wayPoints=null) {

		$client = new Client();

		$url  = 'https://maps.googleapis.com/maps/api/directions/json?';
		$url .= 'origin=' . $origin;
		$url .= '&destination=' . $destination;
		$url .= '&waypoints=' . $wayPoints;
		$url .= '&units=imperial';
		$url .= '&mode=driving';
		$url .= '&key=' . $this->googleApiKey;

		$res = $client->get($url);

		//need to handle this error with a catch
		if ($res->getStatusCode() !== 200) {
			return false;
		}

		return json_decode($res->getBody()->getContents(), true);

	}

	public function getRouteDetails($origin, $destination, $wayPoints=null) {
		//make our API call
		$directions = $this->getDirections($origin, $destination, $wayPoints);
		// there should always only be one route but we are passed an array.
		// loop through array
		$route = [];
		$polyline = '';
		foreach ($directions['routes'] as $route) {
			$polyline = $route['overview_polyline']['points'];
			foreach ($route['legs'] as $leg) {
				$route = $leg;
				//because we are only handling one leg at the minute
				//needs sorting for when we are handling multiple legs
			}
		}
		return [$route, $polyline];
	}
}