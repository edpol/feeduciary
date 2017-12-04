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

 		$rate = Rate::create([
            'roof'       => $roof,
            'rate'       => $rate,
            'advisor_id' => request('advisor_id')
		]);

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
        // After creating your ADVISOR information, we need your RATES information
        return view('advisors.rates', compact('advisor'));
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
}
