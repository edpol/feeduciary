<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

class ZipcodesController extends Controller
{

	public function index() {
		$guest = GeocodeController::getLatLng($zipcode); 
		$location["lat"] = $response->results[0]->geometry->location->lat;
		$location["lng"] = $response->results[0]->geometry->location->lng;
	}
}
