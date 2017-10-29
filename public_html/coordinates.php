<?php
    function geocode($address){
        $addressclean = str_replace (" ", "+", $address);
        $key = "AIzaSyCW4SgcvzZvCuRbODzZuNQ0M82x1KWyRB0 ";
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $addressclean . "&sensor=false&key={$key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = json_decode(curl_exec($ch), true);

        print_r($geoloc);

        var_dump($geoloc['results'][0]['geometry']['location']['lat']);
        var_dump($geoloc['results'][0]['geometry']['location']['lng']);
    }

    $list = ['address1', 'address2', 'city', 'state', 'zipcode'];
    $address = "";
    foreach ($list as $key => $value) {
        if ( isset($_POST[$key]) && strlen($_POST[$key])>0 ) {
            $address += $POST[$key] . "+";
        }
        if (strlen($address)>1) {
            $address = substr($address,0,-1);
            geocode($address);
        }
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

    <form id="form1" action="" method="POST">
        <div style="float:left;">
            <span style="line-height: 2em">&nbsp;</span><br />
            Address 1: <br />
            Address 2: <br />
            City:      <br />
            State:     <br />
            Zip code:  <br />
            Latitude:  <br />
            Longitude: <br />
            <br />
        </div>
        <div style="float:left;" id="entry">
            <input id="address1" type="text" name="address1" /><br />
            <input id="address2" type="text" name="address2" /><br />
            <input id="city"     type="text" name="city"     /><br />
            <input id="state"    type="text" name="state"    /><br />
            <input id="zipcode"  type="text" name="zipcode"  /><br />
            <span id="latitude"  type="text"></span><br />
            <span id="longitude" type="text"></span><br />
            <button id="ajax-button" type="button">Submit</button>
        </div>

        <br clear="all" />
    </form>
    <div id="location">
    </div>


  </body>
</html>
