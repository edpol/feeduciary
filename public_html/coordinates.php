<?php
    function geocode($address){

//      $addressclean = str_replace (" ", "+", $address);
        $addressclean = urlencode(implode(",",$address));
//echo $addressclean;

        $key = "AIzaSyAWOL3Onr0xG3zs0U_vNDk15XOm82qb5wE";
        $details_url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $addressclean . "&sensor=false&key={$key}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
/*
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
*/
        $results = curl_exec($ch);

        $geoloc = json_decode($results, true);
        if ($geoloc["status"] == "REQUEST_DENIED") {
            foreach($geoloc as $key => $err) {
                if ($err!==null && !empty($err)) echo "{$key}: {$err} <br />";
            }
        } else {
            var_dump($geoloc['results'][0]['geometry']['location']['lat']);
            var_dump($geoloc['results'][0]['geometry']['location']['lng']);
        }
    }


    if (isset($_POST["address"])) {
        $address = $_POST["address"];
        geocode($address);
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
            <input id="address1" type="text" name="address[address1]" /><br />
            <input id="address2" type="text" name="address[address2]" /><br />
            <input id="city"     type="text" name="address[city]"     /><br />
            <input id="state"    type="text" name="address[state]"    /><br />
            <input id="zipcode"  type="text" name="address[zip]"  /><br />
            <span id="latitude"  type="text"></span><br />
            <span id="longitude" type="text"></span><br />
            <button id="ajax-button" type="submit">Submit</button>
        </div>

        <br clear="all" />
    </form>
    <div id="location">
    </div>


  </body>
</html>
