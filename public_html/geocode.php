<?php

class GeocodeController //extends Controller
{
    public static $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
    public static $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=false&key=&key=";

    public static function show($advisor) {
        $address =  $advisor->address1 . " " . $advisor->address2 . " " . $advisor->city . " " . $advisor->st . " " . $advisor->zip;
        $clean_address =  urlencode($address);
        $send = self::$url . self::$key . "&address={$clean_address}&components=country:US";
echo "Send: " . $send . "<br />";
        $result = file_get_contents($send);
        $response = json_decode($result);
echo "<hr />";
var_dump($response);
echo "<hr />";
        if ($response->status=="OK") {
            $location['lat'] = $response->results[0]->geometry->location->lat;
            $location['lng'] = $response->results[0]->geometry->location->lng;
        } else {
            $location = false;
        }
        return $location;
    }
}

    if (isset($_GET["address"])) {
    	$address = $_GET["address"];
    	print_r($address);
    	//i need to make you into an objeft
		$a = json_encode($address);
		$b = json_decode($a,false);
		$location = GeocodeController::show($b);
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ajax Zip Code</title>
    <style>
        body { color:white; background-color:black; font-family: monospace; line-height:2.05em; }
        input {margin-bottom:4px; }
        #entry { margin: 2em 1em; }
        #location { margin: 1em; }
    </style>
  </head>
  <body>
  	<br />
    <form action="" method="get">
    	<div style="display:inline-block; width:80px;"> address1:</div> <input type="text" name = "address[address1]"><br />
    	<div style="display:inline-block; width:80px;"> address2:</div> <input type="text" name = "address[address2]"><br />
    	<div style="display:inline-block; width:80px;"> city:    </div> <input type="text" name = "address[city]"><br />
    	<div style="display:inline-block; width:80px;"> state:   </div> <input type="text" name = "address[st]"><br />
    	<div style="display:inline-block; width:80px;"> zip:     </div> <input type="text" name = "address[zip]"><br />
    	<input type="submit" value="submit">
    </form>
<?= "Latitude: " . $location["lat"] ."<br />Longitude: " . $location["lng"]; ?>
</body>
</html>