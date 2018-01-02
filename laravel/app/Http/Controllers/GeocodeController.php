<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

use feeduciary\Advisor;

class GeocodeController extends Controller
{
    public $key;
    public $url;

    public function __constructor() {
        $this->key  = "AIzaSyALzhEzkuqN7XpucdVcJUxR12p2X0W5LnE";
        $this->url  = "https://maps.google.com/maps/api/geocode/json?sensor=false&key={$this->key}";
    }

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public static function getDistance(Advisor $advisor,$zipcode)
    {
        $address  = $advisor->address1 . ",";
        if (!empty($advisor->address2)) $address .= $advisor->address2 . ",";
        $address .= $advisor->city . "," . $advisor->st . " " . $advisor->zip;
        $address = urlencode($address);

        $key2  = "AIzaSyCdltmUqKisvFuUxvU-Ljf7CmTAjV0GZqw";
        $url2  = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&key={$key2}";
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

    public static function geocode ($advisor) {
        $address =  $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
        $clean_address =  urlencode($address);

        $this->url .= "&address={$clean_address}";

        $result = file_get_contents($this->url);
        $response = json_decode($result);
        if ($response->status=="OK") {
            $location['lat'] = $response->results[0]->geometry->location->lat;
            $location['lng'] = $response->results[0]->geometry->location->lng;
        } else {
            $location = false;
        }
        return $location;
    }

    public static function geocode2 ($advisor) {
        $address =  $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
        $clean_address =  urlencode($address);
 
        $this->url .= "&address={$clean_address}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
