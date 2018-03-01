<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\Rate;
use feeduciary\Advisor;

class RatesController extends Controller
{
 
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	return view('advisors.info');
    }

    public function show() {
    	/*
    	ok this is where we end up after entering all of the rates
    	or login in after checking that all of the data has been input 
		*/
    	echo "ok this is where we end up after entering all of the rates<br />";
    	echo "or login in after checking that all of the data has been input <br />";
    	die();

    }

    public function edit(Advisor $advisor){
        // they just pushed the edit rates button
        $msg = array();
//      $rates->where("advisor_id",$advisor->id)->orderBy('roof', 'DESC');
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('rates.edit', compact('advisor','rates'))->withErrors($msg);
    }

    public function store(Advisor $advisor){
        // Validate the form.  email checks email format
        $validator = $this->validate(request(), [
            'roof'       => 'required|string',
            'rate'       => 'required|string',
            'advisor_id' => 'required|numeric'
        ]);

        $roof = cleanMoney(request('roof'));
        $rate = cleanPercent(request('rate'));
        $advisor_id = request('advisor_id');
        $msg = array();

        if($roof>0 && $rate>0) {
                $checkRate = Rate::doesRateExist($advisor_id,$roof);
                $count = (is_null($checkRate)) ? 0 : $checkRate->count();
                if ($count==0) {
                    // can't have same rate for an advisor
                    $rate = Rate::create([
                        'roof'       => $roof,
                        'rate'       => $rate,
                        'advisor_id' => $advisor_id
                    ]);
                } else {
                    $msg["duplicate"] = "Already have an entry for " . number_format($roof);
                }
        } else {
            if($roof<=0) $msg["roof"] = "Roof must be grater than 0";
            if($rate<=0) $msg["rate"] = "Rate must be grater than 0";
        }

        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
//      $advisor = $rates->advisor;
        return view('rates.edit', compact('advisor','rates'))->withErrors($msg);
    }

    public function destroy(Advisor $advisor){
        $msg = array();
        $target = request("delete");
        // if you reload page it repeats last command. If last command was delete you will get a null
        $rate = Rate::find($target);
        if(!is_null($rate)) {
            $rate = Rate::find($target)->delete(); 
        } else {
            $msg["notFound"] = "That rate is aready deleted";
        }
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('rates.edit', compact('advisor','rates'))->withErrors($msg);
    }

    public function done(Advisor $advisor){
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof','DESC')->get();
        $advisor = self::checkURLs($advisor);
        return view('advisors.edit', compact('advisor', 'rates'));
    }
}
