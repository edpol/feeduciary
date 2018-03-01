<?php

namespace feeduciary\Http\Controllers;

//use Illuminate\Http\Request;
use Mail;
use feeduciary\Rate;
use feeduciary\User;
use feeduciary\Pages;
use feeduciary\Advisor;
use feeduciary\Zipcode;

class AdvisorsController extends Controller
{
    public $lat;
    public $lng;
    public $found_zipcode;
    public $perPage = 10;
    public $distance = array();

    public function __construct()
    {
//      $this->middleware('auth')->except(['index', 'show', 'advisorFee', 'calculateFee', 'page']);
        $this->middleware('auth')->only(['create','delete']); // is this just logged in?
    }

    //
    public function index()
    {
        $advisors = Advisor::paginate(10); //all();
        return view('advisors.index', compact('advisors'));
    }

    //
    public function show(Advisor $advisor)
    {
        $advisor = self::checkURLs($advisor);
        return view('advisors.show', compact('advisor'));
    }

    /*
     *  Calculate the advisors fee
     */
    private function advisorFee($advisor, $amount) {
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
        return round($totalFee,0);
    }

    public function calculateDistanceAndFee() {
        $min = 1000000;
        $max = -1;
        $step = 1;
        $range = array("min"=>0, "max"=>0, "step"=>1);
        $amount   = session('amount');
        $advisors = session('advisors');
        foreach ($advisors as $advisor) {
            if ($advisor->is_active && $this->found_zipcode) {
                $data = GeocodeController::distance($this->lat, $this->lng, $advisor->lat, $advisor->lng,"M",$advisor->id, $advisor->zip);
                $data = round($data,0);
                if ($data!==false) {
                    $advisor->distance = $data;
                    if ($data > $max) {$max = $data;}
                    if ($data < $min) {$min = $data;}
                }
            }
            $advisor->totalFee=$this->advisorFee($advisor,$amount);
        }
        if ($max >= $min) {
            if ($min>10) $min = (floor($min/10)) * 10;
            if ($max>10) $max = (ceil ($max/10)) * 10;
            $step = 1; //if > 20 ceil( ($max-$min) / 20 );
            $range = array("min"=>$min, "max"=>$max, "step"=>$step);
        }
        session(compact('advisors', 'range'));
        return;
    }

    public function calculateFee() {

        $this->validate(request(), ['amount'=>'required']);
        $tmp = implode('',request(['amount'])); // array to string
        $amount = cleanMoney($tmp);
        session(compact('amount'));

        $zip = implode('',request(['zipcode']));
        $zip = cleanZipcode($zip);
        $advisors = Advisor::where("minimum_amt", "<", $amount)->get();
        session(compact('advisors'));

        /*
         *  Guest supplies zipcode
         *  lookup in zipcodes table
         *  if fails ask Google and save results in zipcodes table
         */
        $zipcode = new Zipcode();
        $guest = $zipcode->show($zip);

        if ($guest === NULL || $guest === false) {
            $guest = GeocodeController::getLatLng($zip); 
            if ($guest !== NULL && $guest !== false) {
                $zipcode->zip = $zip;
                $zipcode->lat = $guest["lat"];
                $zipcode->lng = $guest["lng"];
                $zipcode->save();
//              $zipcode->store(($guest));
           }
        }

        if ($guest === NULL || $guest === false) {
            $this->found_zipcode = false;
        } else {
            $this->found_zipcode = true;
            $this->lat = $guest["lat"];
            $this->lng = $guest["lng"];
        }
        $this->calculateDistanceAndFee();

        $advisors = $advisors->sortBy('totalFee');
        $newOrder = ["val" => "sortByDistance", "text" => "Sort by Distance"];
        $page = 1;
        $range = session('range');
        $miles = (int) $range['max'];

        session(compact('advisors'));
        $output = $this->slicer($page,$miles);

        $found_zipcode = $this->found_zipcode;
        session(compact('zip', 'found_zipcode', 'range', 'newOrder', 'miles'));
        return view('casual.wait',compact('page'));
//      return view('advisors.calculateFee', compact('page'));
    }

    public function page($page)
    {   /* I think this would work with public variables */
        $miles = session('miles');
        $output = $this->slicer($page,$miles);  // needs advisors in session
        return view('advisors.calculateFee', compact('page'));
    }

    /*
     *  the target key is always one less than the id, in this example
     *  forget($advisor->id -1) should work, but just to be sure
     */
    public function forgetById($collection,$id){
        foreach($collection as $key => $item){
            if($item->id == $id){
                $collection->forget($key);
                break;
            }
        }
        return $collection;
    }

    // now the slicer just got complicated
    public function slicer($page, $miles)
    {
        $advisors = session('advisors');
        $clone = clone $advisors;
        $found_zipcode = session('found_zipcode');
        if ($found_zipcode) {
            foreach($clone as &$advisor) {
                if ($advisor->distance > $miles || !$advisor->is_active) {
                    $clone = $this->forgetById($clone,$advisor->id);
                }
            }
/*          $events = $events->filter(function($event) use ($scheduling) {
                return $event->scheduling == $scheduling;
            });

            $filtered = $advisors->filter(function ($is_active, $key) {
                return $is_active == 1;
            });
            $filtered->all();
            // [3, 4]
*/      }
        $page = (!isset($page)) ? 1 : (int)$page;
        $start_slice = ($page-1) * Pages::$per_page;

        //good starting point, now 
        $output = $clone->slice($start_slice, Pages::$per_page);
        $displayCount = count($clone);
        session(compact('output', 'advisors', 'displayCount', 'validAdvisorCount')); 
        // I could send count($clone) instead would save ram.
        return $output;
    }

    public function range($miles)
    {
        session(compact('miles'));
        $page = 1;
        $output = $this->slicer($page,$miles);
        return view('advisors.calculateFee', compact('page'));
    }

    public function resort($order)
    {
        $sort = $order; //$request->sortOrder;
        $advisors  = session('advisors');

        if ($sort=="sortByDistance") {
            $advisors  = $advisors->sortBy('distance');
            $newOrder = ["val" => "sortByTotalFee", "text" => "Sort by Fee"];
        } else {
            $advisors  = $advisors->sortBy('totalFee');
            $newOrder = ["val" => "sortByDistance", "text" => "Sort by Distance"];
        }

        $page = 1;
        $miles = session('miles');
        $range = session('range');
        $max = $range["max"];
        session(compact('advisors'));
        $output = $this->slicer($page,$miles);  // needs $advisors in session
        session(compact('newOrder'));
        return view('advisors.calculateFee', compact('page'));
    }

    /*
     *  so i send it 
     */
    public function buildArray() {
        $minimum_amt      = cleanMoney(request('minimum_amt'));
        $maximum_amt      = cleanMoney(request('maximum_amt'));
        $minimum_fee      = cleanMoney(request('minimum_fee'));
        $discretionaryAUM = cleanMoney(request('discretionaryAUM'));

        $user_id = (request('user_id') === null) ? 0 : request('user_id');

        $data = array(
            'name'            => request('name'),
            'phone'           => request('phone'),
            'email'           => request('email'),
            'company'         => request('company'),
            'address1'        => request('address1'),
            'address2'        => request('address2'),
            'city'            => request('city'),
            'st'              => request('st'),
            'zip'             => request('zip'),
            'url'             => request('url'),
            'minimum_amt'     => $minimum_amt,
            'maximum_amt'     => $maximum_amt,
            'minimum_fee'     => $minimum_fee,
            'feeCalculation'  => request('feeCalculation'),
            'facebook'        => request('facebook'),
            'finraBrokercheck'=> request('finraBrokercheck'),
            'linkedin'        => request('linkedin'),
            'twitter'         => request('twitter'),
            'discretionaryAUM'=> $discretionaryAUM,
            'brochure'        => request('brochure'),
            'bio'             => request('bio'),
            'user_id'         => $user_id
        );

        // if not pull address out of function and build it outside
        $object = json_decode(json_encode($data), FALSE); // array -> JSON -> object
        $location = GeocodeController::show($object);
        if ($location!==false) {
            $data['lat'] = $location['lat'];
            $data['lng'] = $location['lng'];
        }

        return $data;
    }

    public function validating() {
        // Validate the form.  email checks email format
        $validation = $this->validate(request(), [
            'name'        => 'required|string|min:2',
            'email'       => 'required|email:unique:advisors',
            'zip'         => 'required|string|min:5',
            'feeCalculation' => 'required'
        ]);
        return $validation;
    }

    public function store() {
        $validation = $this->validating();
        $data = $this->buildArray();

        $advisor = Advisor::create($data);
        $rates = $advisor->rate;

        // After creating your ADVISOR information, we need your RATES information
        return view('rates.edit', compact('advisor','rates'));
    }

    // this goes to the form to get new advisor information
    public function edit(Advisor $advisor) {
        $state = optionState($advisor->st);
        return view('advisors.update', compact('advisor','state'));
    }

    public function update(Advisor $advisor) {
        $validation = $this->validating();
        //advisor has the old data, request has the new
        $data = $this->buildArray();
        $advisor->update($data);

        $rates = Rate::where("advisor_id",$advisor->id)->get();
        if ($rates->count()==0) {
            $rates = $advisor->rate;
            return view('rates.edit', compact('advisor','rates'));
        }

        // advisor.edit is in LoginController and AdvisorController
        $advisor = self::checkURLs($advisor);
        return view('advisors.edit', compact('advisor', 'rates'));

    }

    public function contact (Advisor $advisor) {
        return view('advisors.contact', compact('advisor'));
    }

    public function delete($id){
//      Advisor::destroy($id);
        $results = Advisor::where('id', $id)->delete();
        $results = Rate::where("advisor_id",$id)->delete();
        return redirect('/admin/advisors')->with('status', "Advisor {$id} deleted!");
    }
}
