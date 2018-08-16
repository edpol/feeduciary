<?php
    function scheme() {
        if(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != 'off') {
            return "https://";
        } else {
            return "http://";
        }
    }

    // remove everything except numbers and first period
    // or should we just remove dollar signs, commas and periods (except first) and let it error otherwise
    function cleanMoney ($price_string) {
        $price = preg_replace('/[^0-9.]+/', '', $price_string);
        if (($pos = strpos($price, '.')) !== false) {
            $price = substr($price, 0, $pos+1).str_replace('.', '', substr($price, $pos+1));
        }
        return floatval($price);
    }

    // remove everything except numbers and first period
    function cleanPercent ($percent_string) {
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

    function cleanZipcode($zip) {
        return preg_replace("/[^a-z0-9.]+/i", "", $zip);
    }

    function optionState ($state="",$tabindex=0) {

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

        $msg = '<select id="st" name="st" class="form-control"';
        if ($tabindex>0) $msg .= " tabindex={$tabindex} ";
        $msg .= ">\n";
        foreach ($us_states as $abbr => $name) {
            $state    = $name[0];
            $selected = $name[1];
            $disabled = $name[2];
            $msg .= "\t\t\t\t\t\t\t\t\t<option {$selected} {$disabled} value='{$abbr}'>{$state}</option>\n";
        }
        $msg .= "\t\t\t\t\t\t\t\t</select>\n";
        return $msg;    
    }


    /*
     *  if the url is missing the http:// string, prepend it
     *  we can also add whatever is supplied in the scheme parameter
     */
    function addScheme($url, $scheme = 'http://') {
        if (empty($url)) {
            $result = "";
        } else {
            $result = is_null(parse_url($url, PHP_URL_SCHEME)) ? "http://" . $url : $url;
        }
        return $result;
    }

    // these are all the columns that are set as url's
    function checkURLs($advisor) {
        $urlList = array("url", "facebook", "finraBrokercheck", "linkedin", "twitter", "brochure");
        foreach($urlList as $target) {
            $advisor->$target = addScheme($advisor->$target);
        }
        return $advisor;
    }
