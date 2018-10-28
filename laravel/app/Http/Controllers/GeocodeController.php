<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

use feeduciary\Advisor;

class GeocodeController extends Controller
{
    // this resides in feeduciary@gmail.com
    public static $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    public static $coordinatesKey = "AIzaSyAdmDDq3txX-zNf4BNXh8e3baSfkgyl1HA";
    public static $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&key=";
/*
    public function __constructor() {
        $this->key  = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE";
        $this->url  = "https://maps.google.com/maps/api/geocode/json?sensor=false&key={self::$key}";
    }
*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advisors = Advisor::all();
        foreach ($advisors as $advisor) {
            $this->store($advisor);
        }
        return view('geocode.index', compact('advisors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Advisor $advisor) {
        $location = self::geocode($advisor);

        $msg = "";
        if ($location===false) {
            $msg = "Error, undefined offset with " . $advisor->id . " " . $advisor->name;
        } else {
            $advisor->lat = $location['lat'];
            $advisor->lng = $location['lng'];
            $advisor->save();
        }

        return view('geocode.store', compact('advisor', 'msg'));
    }

    public static function sslFileGetContents($send) {
        $cafile = __DIR__ . DIRECTORY_SEPARATOR . "cacert.pem";
        $arrContextOptions=array(
            "ssl"=>array(
                "cafile" => $cafile,
                "verify_peer"=> true,
                "verify_peer_name"=> true,
            ),
        );

        $response = file_get_contents($send, false, stream_context_create($arrContextOptions));
        return $response;
    }

    public static function show($advisor) {
        $address =  $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
        $clean_address =  urlencode($address);
        $send = self::$url . self::$coordinatesKey . "&address={$clean_address}&components=country:US";

        try {
//            if (getenv('APP_ENV')=="local") {
                $result = self::sslFileGetContents($send);
//            } else {
//                $result = file_get_contents($send);
//            }
            if ($result === false) {
                throw new Exception('file_get_contents returned a false');
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            die();
        }

        $response = json_decode($result);
        if ($response->status=="OK") {
            $location['lat'] = $response->results[0]->geometry->location->lat;
            $location['lng'] = $response->results[0]->geometry->location->lng;
        } else {
            $location = false;
        }
        return $location;
    }

    public static function getLatLng($zip) {
        $location = false;
        if(!empty($zip) && (strlen(trim($zip))>4)) {
            $result = file_get_contents(self::$url . self::$key . "&address={$zip}");
            $response = json_decode($result);
            if ($response->status=="OK") {
                $location["zip"] = $zip;
                $location["lat"] = $response->results[0]->geometry->location->lat;
                $location["lng"] = $response->results[0]->geometry->location->lng;
            }
        }
        return $location;
    }

    public static function distance($lat1, $lng1, $lat2, $lng2, $unit="M", $id=0, $zip="") {
        $theta = $lng1 - $lng2;
        $dist  = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $dist  = acos($dist);
        $dist  = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit  = strtoupper($unit);
/*
if($id==76) {
	echo "ID:   " . $id   . "<br />";
	echo "zip:  " . $zip  . "<br />";
	echo "Lat1: " . $lat1 . "<br />";
	echo "Lng1: " . $lng1 . "<br />";
	echo "Lat2: " . $lat2 . "<br />";
	echo "Lng2: " . $lng2 . "<br />";
	echo "Miles: " . $miles . "<br />";
	die();
}
*/
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public static function geocode($advisor) {
        $address =  $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
        $clean_address =  urlencode($address);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::$url  . self::$key . "&address={$clean_address}" );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = json_decode(curl_exec($ch));
        curl_close($ch);

        if (isset($response->results[0])) {
            $location['lat'] = $response->results[0]->geometry->location->lat;
            $location['lng'] = $response->results[0]->geometry->location->lng;
        } else {
            $location = false;
        }
        return $location;
/*
 https://maps.googleapis.com/maps/api/distancematrix/json
 ?origins=dehli &destinations=pune &mode=bicycling &language=en-EN &sensor=true &key=AppKey
*/
    }

}
