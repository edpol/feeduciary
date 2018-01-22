<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
	Public function show($zip) {
		$row = $this->where('zip',$zip)->first(); 
		if ($row===NULL) {
			$location=false;
		} else {
			$location["lat"]=$row["lat"];
			$location["lng"]=$row["lng"];
		}
		return $location;
	}

	public function store($location) {
		$this->zip = $location["zip"];
		$this->lat = $location["lat"];
		$this->lng = $location["lng"];
//		date("Y-m-d H:i:s", strtotime(date());
		$this->save();
/*
		$this->insert(array('zip' => $location["zip"],
		          			'lat' => $location["lat"],
		          			'lng' => $location["lng"])
		);
*/
	}
}
