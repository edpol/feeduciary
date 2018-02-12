<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

use feeduciary\Advisor;

class GeocodeController extends Controller
{
    // this resides in feeduciary@gmail.com
//    public static $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    public static $key = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE";
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
        foreach ($advisors as $advisor){
            $this->store($advisor);
        }
        return view('geocode.index', compact('advisors'));
    }

    /*
     *  Takes Advisor Address and gets lat & lng
     *  used with new Advisor and when an Advisor is updated
     */
    public static function nossl_file_get_contents($send) {

        $stream_opts = [
            "ssl" => [
            "verify_peer"=>false,
            "verify_peer_name"=>false,
            ]
        ];  
     
        $response = file_get_contents($send, false, stream_context_create($stream_opts));
        return $response;
    }


    public static function ssl_file_get_contents($send) {
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
        $send = self::$url . self::$key . "&address={$clean_address}&components=country:US";

        try {
//            $result = file_get_contents($send);
// this should fail in server
            $result = self::ssl_file_get_contents($send);
            if ($result === false) {
                var_dump($result);
                die();
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

    public static function getDistance(Advisor $advisor, $zipcode)
    {
        $address  = $advisor->address1 . ",";
        if (!empty($advisor->address2)) $address .= $advisor->address2 . ",";
        $address .= $advisor->city . "," . $advisor->st . " " . $advisor->zip;
        $address = urlencode($address);

        $key2  = "AIzaSyCdltmUqKisvFuUxvU-Ljf7CmTAjV0GZqw";
        $url2  = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&key=" . $key2;
        $url2 .= "&origins={$zipcode}"; 
        $url2 .= "&destinations={$address}";
        $result = file_get_contents($url2);
        $response = json_decode($result);

        if ($response->status=="OK") {
            $data["distance"] = $response->rows[0]->elements[0]->distance->text;
            $data["duration"] = $response->rows[0]->elements[0]->duration->text;
        } else {
            $data = false;
        }
        return $data;
    }

    public static function geocode2($advisor) {
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

}
