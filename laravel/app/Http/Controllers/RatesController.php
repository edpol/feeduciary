<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rate;
use App\Advisor;

class RatesController extends Controller
{
 
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
    	return view('advisors.info');
    }

    public function store () {
        // Validate the form.  email checks email format

        $this->validate(request(), [
            'roof'       => 'required',
            'rate'       => 'required',
            'advisor_id' => 'required'
        ]);

        $roof = $this->cleanMoney(request('roof'));
        $rate = $this->cleanPercent(request('rate'));
        $advisor_id = request('advisor_id');
        $msg = "";

        $advisorsRates = Rate::where("advisor_id",$advisor_id)->where("roof",$roof)->orderBy('roof', 'DESC')->get();

        $count = (is_null($advisorsRates)) ? 0 : $advisorsRates->count();
        if ($count==0) {
            // can't have same rate for an advisor
     		$rate = Rate::create([
                'roof'       => $roof,
                'rate'       => $rate,
                'advisor_id' => $advisor_id
    		]);
        } else {
            $msg = "Already have an entry for " . number_format($roof);
        }

		// when we come from /login $advisor is an object
		// when we come from rates.blade.php it's a JSON string
		// so change it to array 
 		$advisor = request('advisor');
 		if (gettype($advisor)!='object') {
	 		$array = json_decode(request('advisor'),true);	// change JSON string to array
			$advisor = new advisor();						// new advisor object, then populate
			foreach ($array as $key => $value) {
				$advisor->{$key} = $value;
			}
		}
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        // After creating your ADVISOR information, we need your RATES information
        return view('rates.store', compact('advisor','msg','rates'));
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
//        $rates->where("advisor_id",$advisor->id)->orderBy('roof', 'DESC');
        $msg = "";
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('rates.edit', compact('advisor','msg','rates'));
    }

    public function newRate(Advisor $advisor){
        // Validate the form.  email checks email format

        $this->validate(request(), [
            'roof'       => 'required',
            'rate'       => 'required',
            'advisor_id' => 'required'
        ]);

        $roof = $this->cleanMoney(request('roof'));
        $rate = $this->cleanPercent(request('rate'));
        $advisor_id = request('advisor_id');
        $msg = "";

        $advisorsRates = Rate::where("advisor_id",$advisor_id)->where("roof",$roof)->orderBy('roof', 'DESC')->get();

        $count = (is_null($advisorsRates)) ? 0 : $advisorsRates->count();
        if ($count==0) {
            // can't have same rate for an advisor
            $rate = Rate::create([
                'roof'       => $roof,
                'rate'       => $rate,
                'advisor_id' => $advisor_id
            ]);
        } else {
            $msg = "Already have an entry for " . number_format($roof);
        }

        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
//      $advisor = $rates->advisor;
        return view('rates.edit', compact('advisor','msg','rates'));
    }

    public function destroy(Advisor $advisor){
        $msg = "";
        $target = request("delete");
        echo "Deleting " . $target . "<br />\n";
        $rate = Rate::find($target)->delete(); 
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('rates.edit', compact('advisor','msg','rates'));
    }

    public function done(Advisor $advisor){
        $rates = Rate::where("advisor_id",$advisor->id)->orderBy('roof', 'DESC')->get();
        return view('advisors.edit', compact('advisor', 'rates'));
    }
}
