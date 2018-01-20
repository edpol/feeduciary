<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // remove everything except numbers and first period
    // or should we just remove dollar signs, commas and periods (except first) and let it error otherwise
    public function cleanMoney ($price_string) {
        $price = preg_replace('/[^0-9.]+/', '', $price_string);
        if (($pos = strpos($price, '.')) !== false) {
            $price = substr($price, 0, $pos+1).str_replace('.', '', substr($price, $pos+1));
        }
        return floatval($price);
    }

    // remove everything except numbers and first period
    public function cleanPercent ($percent_string) {
        $percent = preg_replace('/[^0-9.%]+/', '', $percent_string);
        // remove extra periods
        if (($pos = strpos($percent, '.')) !== false) {
            $percent = substr($percent, 0, $pos+1).str_replace('.', '', substr($percent, $pos+1));
        }
        // if a % found, sub-string position 0 to percent sign then divide by 100
        if (($pos = strpos($percent, '%')) !== false) {
            $percent = substr($percent, 0, $pos)*.01;
 		} else {
            $percent = $percent * .01;
        }
        return floatval($percent);
    }

    public function curl($url, $ua = FALSE) {
        if($ua == false){
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL , $url);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch , CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($ch , CURLOPT_USERAGENT , $ua);
        curl_setopt($ch , CURLOPT_SSL_VERIFYPEER, false); 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function rss() {
        $url = 'https://www.fa-mag.com/fa-online/online-articles/rss';
        $output = $this->curl($url);
        $xml = new \SimpleXMLElement($output);

        $msg = "<ul>\n";
        foreach ($xml->channel->item as $item) {
            $msg .= "<li>\n";
            $msg .= '<p><strong>';
            $msg .= '<a href="'.$item->link.'" title="'.$item->title.'">'.$item->title.'</a>';
            $msg .= '</strong><br />';
            $msg .= '<small><em>Posted on '.$item->pubDate.'</em></small></p>';
            $msg .= '<p>'.$item->description.'</p>';
            $msg .= "</li>";
        }
        $msg .= "</ul>\n";

        return view('casual.rss', compact('result','msg'));
    }

    /*
     *  if the url is missing the http:// string, prepend it
     *  we can also add whatever is supplied in the scheme parameter
     */
    public static function addScheme($url, $scheme = 'http://') {
        if (empty($url)) {
            $result = "";
        } else {
            $result = is_null(parse_url($url, PHP_URL_SCHEME)) ? "http://" . $url : $url;
        }
        return $result;
    }

    // these are all the columns that are set as url's
    public static function checkURLs($advisor) {
        $urlList = array("url", "facebook", "finraBrokercheck", "linkedin", "twitter", "brochure");
        foreach($urlList as $target) {
            $advisor->$target = self::addScheme($advisor->$target);
        }
        return $advisor;
    }

    public function optionState ($state="") {

        $us_states = array (
             ""  => ["Choose", "", "disabled"],
            "AL" => ["Alabama", "", ""],
            "AK" => ["Alaska", "", ""],
            "AS" => ["American Samoa", "", ""],
            "AZ" => ["Arizona", "", ""],
            "AR" => ["Arkansas", "", ""],
            "CA" => ["California", "", ""],
            "CO" => ["Colorado", "", ""],
            "CT" => ["Connecticut", "", ""],
            "DE" => ["Delaware", "", ""],
            "DC" => ["District of Columbia", "", ""],
            "FL" => ["Florida", "", ""],
        //  "FM" => ["Federated States of Micronesia",  "", ""],
            "GA" => ["Georgia", "", ""],
            "GU" => ["Guam", "", ""],
            "HI" => ["Hawaii", "", ""],
            "ID" => ["Idaho", "", ""],
            "IL" => ["Illinois", "", ""],
            "IN" => ["Indiana", "", ""],
            "IA" => ["Iowa", "", ""],
            "KS" => ["Kansas", "", ""],
            "KY" => ["Kentucky", "", ""],
            "LA" => ["Louisiana", "", ""],
            "ME" => ["Maine", "", ""],
            "MH" => ["Marshall islands", "", ""],
            "MD" => ["Maryland", "", ""],
            "MA" => ["Massachusetts", "", ""],
            "MI" => ["Michigan", "", ""],
            "MN" => ["Minnesota", "", ""],
            "MS" => ["Mississippi", "", ""],
            "MO" => ["Missouri", "", ""],
            "MT" => ["Montana", "", ""],
            "NE" => ["Nebraska", "", ""],
            "NV" => ["Nevada", "", ""],
            "NH" => ["New Hampshire", "", ""],
            "NJ" => ["New Jersey", "", ""],
            "NM" => ["New Mexico", "", ""],
            "NY" => ["New York", "", ""],
            "NC" => ["North Carolina", "", ""],
            "ND" => ["North Dakota", "", ""],
        //  "MP" => ["Northern Mariana Islands",  "", ""], -->
            "OH" => ["Ohio", "", ""],
            "OK" => ["Oklahoma", "", ""],
            "OR" => ["Oregon", "", ""],
            "PW" => ["Palau", "", ""],
            "PA" => ["Pennsylvania", "", ""],
            "PR" => ["Puerto Rico", "", ""],
            "RI" => ["Rhode Island", "", ""],
            "SC" => ["South Carolina", "", ""],
            "SD" => ["South Dakota", "", ""],
            "TN" => ["Tennessee", "", ""],
            "TX" => ["Texas", "", ""],
        //  "UM" => ["U.S. Minor Outlying Islands", "", ""], -->
            "UT" => ["Utah", "", ""],
            "VT" => ["Vermont", "", ""],
            "VI" => ["Virgin Islands", "", ""],
            "VA" => ["Virginia", "", ""],
            "WA" => ["Washington", "", ""],
            "WV" => ["West Virginia", "", ""], 
            "WI" => ["Wisconsin", "", ""],
            "WY" => ["Wyoming", "", ""]
        );

        if (array_key_exists($state, $us_states)) {
            $us_states[$state][1] = " selected";
        } else {
            $us_state[""] = ["Choose", "selected", "disabled"];
        }

        $msg = '<select id="st" name="st" class="form-control">' . "\n";
        foreach ($us_states as $abbr => $name) {
            $state    = $name[0];
            $selected = $name[1];
            $disabled = $name[2];
            $msg .= "\t\t\t\t\t\t\t\t\t<option {$selected} {$disabled} value='{$abbr}'>{$state}</option>\n";
        }
        $msg .= "\t\t\t\t\t\t\t\t</select>\n";
        return $msg;    

    }

}