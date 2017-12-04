<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // remove everything except numbers and first period
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
 		}
        return floatval($percent);
    }

    public function rss() {
        return view('casual.rss');
    }

    public function editState ($state="XX") {

        $us_states = array (
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
            $us_state["XX"] = ["Choose", "selected", "disabled"];
        }

        $msg = '<select id="st" name="st" class="form-control">' . "\n";
        foreach ($us_states as $abbr => $name) {
            $selected = $name[1];
            $msg .= "\t" . '<option' . $selected . ' value="' . $abbr . '">' . $name[0] . "</option>\n";
        }
        $msg .= "</select>\n";
        return $msg;    

    }
}