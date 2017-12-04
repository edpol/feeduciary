<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Rate;
use App\User;
use App\Advisor;

class AdvisorsController extends Controller
{
    public function __construct()
    {
//      $this->middleware('auth')->except(['index', 'show', 'advisorFee', 'calculateFee', 'page']);
        $this->middleware('auth')->only(['create']);
    }

    //
    public function index()
    {
        $advisors = Advisor::all();
        return view('advisors.index', compact('advisors'));
    }

    //
    public function show(Advisor $advisor)
    {
        return view('advisors.show', compact('advisor'));
    }

    /*
     *  Calculate the advisors fee
     */
    private function advisorFee ($advisor, $amount) {
        $rate_list = Rate::where("advisor_id",$advisor->id)->orderBy('roof','ASC')->get();
        $investment = (float)$amount;
        $base = (float) 0;
        $floor = (float) 0;
        $charge = (float) 0;
        $totalFee = (float) 0;

        foreach ($rate_list as $row) {
            $roof = (float) $row["roof"];
            $rate = (float) $row["rate"];

            if ($advisor->feeCalculation == 0) {
                if ($investment >= $roof) {
                    $base = ($roof-$floor);
                    $charge = ($roof-$floor)*$rate;
                } else if (($investment-$floor)>0) {
                    $base = ($investment-$floor);
                    $charge = ($investment-$floor)*$rate;
                } else {
                    $base = 0;
                    $charge = 0;
                }
                $totalFee += $charge;
                $floor = $roof;
            }
            if ($advisor->feeCalculation == 1) {
                if ($investment >= $floor) {
                    $charge = $investment * $rate;
                    $floor = $roof;
                }
                $totalFee = $charge;
                $base = $investment;
            }
        }
        return $totalFee;
    }

    public function calculateFee () {
        $this->validate(request(), ['amount'=>'required']);
        $tmp = implode('',request(['amount'])); // array to string
        $amount = $this->cleanMoney($tmp);
        $zipcode = implode('',request(['zipcode']));
        $advisors = Advisor::where("minimum_amt", "<", $amount)->get();

        $list = array();
        foreach ($advisors as $advisor) {

            $advisor->totalFee=$this->advisorFee($advisor,$amount);

            $list[] = [ "id"=>$advisor->id, "totalFee"=>$this->advisorFee($advisor,$amount), "advisor"=>$advisor];
        }
        $advisors = $advisors->sortBy('totalFee');

        session(compact('amount', 'zipcode', 'advisors'));
        return view('advisors.calculateFee');
//      return view('advisors.calculateFee', compact('amount', 'zipcode', 'advisors'));
    }

    public function page($page)
    {
        return view('advisors.calculateFee', compact('page'));
    }

    public function store () {
        // Validate the form.  email checks email format
        $this->validate(request(), [
            'name'     => 'required',
            'email'    => 'required|email',
            'feeCalculation' => 'required'
        ]);

        $minimum_amt = $this->cleanMoney(request('minimum_amt'));
        $maximum_amt = $this->cleanMoney(request('maximum_amt'));
        $minimum_fee = $this->cleanMoney(request('minimum_fee'));

        $data = array(            
            'name'        => request('name'),
            'phone'       => request('phone'),
            'email'       => request('email'),
            'company'     => request('company'),
            'address1'    => request('address1'),
            'address2'    => request('address2'),
            'city'        => request('city'),
            'st'          => request('st'),
            'zip'         => request('zip'),
            'url'         => request('url'),
            'minimum_amt' => $minimum_amt,
            'maximum_amt' => $maximum_amt,
            'minimum_fee' => $minimum_fee,
            'feeCalculation' => request('feeCalculation'),
            'brochure'    => request('brochure'),
            'blurb'       => request('blurb'),
            'user_id'     => request('user_id')
        );

        // if not pull address out of function and build it outside
        $object = json_decode(json_encode($data), FALSE);
        $location = GeocodeController::geocode($object);
        if ($location!==false) {
            $data['lat'] = $location['lat'];
            $data['lng'] = $location['lng'];
        }

        $advisor = Advisor::create($data);

        // After creating your ADVISOR information, we need your RATES information
        return view('advisors.rates', compact('advisor'));
    }
}

/*  index, store, show, 
    create, edit, update, destroy */
