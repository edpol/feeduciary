<?php
    function cleanZipcode($zip) {
        return preg_replace("/[^a-z0-9.]+/i", "", $zip);
    }

    function optionState ($state="") {

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