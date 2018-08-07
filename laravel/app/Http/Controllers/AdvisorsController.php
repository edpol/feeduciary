<?php

namespace feeduciary\Http\Controllers;

//use Illuminate\Http\Request;
use Mail;
use feeduciary\Rate;
use feeduciary\User;
use feeduciary\Pages;
use feeduciary\Advisor;
use feeduciary\Zipcode;
use Illuminate\Http\Request;

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
        $this->middleware('auth')->only(['create','delete']); // this just logged in, not checking admin
    }

    //
    public function index(Request $request)
    {
        $request->session()->forget('findme'); 
        $advisors = Advisor::orderBy('name','asc')->paginate(ROWS_PER_PAGE); //all();
        return view('advisors.index', compact('advisors'));
    }

    //
    public function show(Advisor $advisor)
    {
        $advisor = checkURLs($advisor);
        $fb_pixel_view_content = true;
        return view('advisors.show', compact('advisor','fb_pixel_view_content'));
    }

    public function welcome(User $user)
    {
        $advisor = Advisor::where("user_id",$user->id)->first();
        // if user has no advisor entry, go to login 
        $count = (is_null($advisor)) ? 0 : $advisor->count();
        if ($count==0) {
            return redirect('/login')->with('email', $user->email);
        } else {
            $advisor = checkURLs($advisor);
            return view('advisors.show', compact('advisor'));
        }
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
            if ($advisor->feeCalculation == 2) {
                $totalFee = $roof;
            }

        }

        if ($advisor->minimum_fee>$totalFee) {
            $totalFee = $advisor->minimum_fee;
        }

        return round($totalFee,0);
    }

    public function calculateDistanceAndFee() {
        $min = 1000000;
        $max = -1;
        $feeMin = 2^32-1;
        $feeMax = -1;
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
            if ($advisor->totalFee<$feeMin) $feeMin=$advisor->totalFee;
            if ($advisor->totalFee>$feeMax) $feeMax=$advisor->totalFee;
        }
        if ($max >= $min) {
            if ($min>10) $min = (int) (ceil($min/10)) * 10;
            if ($max>10) $max = (int) (ceil($max/10)) * 10;
            $step = 1; //if > 20 ceil( ($max-$min) / 20 );
            $range = array("min"=>$min, "max"=>$max, "step"=>$step);
        }
        $range["feeMin"]  = (int) (ceil($feeMin/10)) * 10;
        $range["feeMax"]  = (int) (ceil($feeMax/10)) * 10;
        $range["feeStep"] = (int) ceil(($feeMax-$feeMin)/100);
        $range["feeMax"] += $range["feeStep"];
        session(compact('advisors', 'range'));
        return;
    }

    /* this is the initialization function */
    public function calculateFee(Request $request) {

        $requestData = $request->all();
        $requestData['amount'] = substr($requestData['amount'],2);
        $request->replace($requestData);

        $this->validate(request(), ['amount'=>'required|numeric|min:1']);
        $tmp = implode('',request(['amount'])); // array to string
        $amount = cleanMoney($tmp);
        session(compact('amount'));

        $zip = implode('',request(['zipcode']));
        $zip = cleanZipcode($zip);
        $advisors = Advisor::where("minimum_amt", "<=", $amount)->get();
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

        $advisors = $this->resort();
        $page = 1;
        $range = session('range');
        $miles = ($range['min']>75) ? (int) $range['min'] : 75; //(int) $range['max'];
        $fee = (int) $range['feeMax'];
        $this->slicer($page,$miles,$fee);

        $found_zipcode = $this->found_zipcode;
        session(compact('page', 'zip', 'found_zipcode', 'range', 'newOrder', 'miles', 'fee'));
        return view('casual.wait', compact('page'));
//      return view('advisors.calculateFee');
    }

    /*
     *  I only use /advisors/results exiting the wait page.
     *  This way we only call the facebook pixel the first time they go to page 1
     *  on other calls it uses /advisors/page/1
     */
    public function facebookPixel() {
        $this->pagePrep();
        return view('advisors.calculateFee', compact('fb_pixel_search'));
    }

    public function pagePrep($page=1)
    {
        session(compact('page'));
        $miles = session('miles');
        $advisors = session('advisors');
        $fee = session('fee');
        $this->slicer($page,$miles,$fee);
        return;
    }
    public function page($page) //,$fb_pixel_search = false)
    {
        $this->pagePrep($page);
        return view('advisors.calculateFee', compact('fb_pixel_search'));
    }

    /** the target key is always one less than the id, in this example
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
    public function slicer($page, $miles, $fee)
    {
        $advisors = session('advisors');
        if (gettype($advisors)!="object") return redirect('/');
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
            $filtered->all();    // [3, 4]
*/      }
        // we have to do this loop even if there is no zip code
        $displayCount = 0;
        foreach($clone as &$advisor) {
            if ($advisor->totalFee > $fee || !$advisor->is_active) {
                $clone = $this->forgetById($clone,$advisor->id);
            } else {
                $displayCount++;
            }
        }
        $pages = new Pages($displayCount, $page);
        if ($page>$pages->totalPages()) $page=$pages->totalPages();
        $page = (!isset($page)) ? 1 : (int)$page;
        $start_slice = ($page-1) * $pages->per_page;

        //good starting point, now pagination
        $output = $clone->slice($start_slice, $pages->per_page);
        $displayCount = count($clone);
        session(compact('page', 'output', 'advisors', 'displayCount', 'validAdvisorCount')); 
        // I could send count($clone) instead would save ram.
        return; //$output;
    }

    public function range($miles)
    {
        session(compact('miles'));
        $page = session('page');
        $fee = session('fee');
        $this->slicer($page,$miles,$fee);
        return view('advisors.calculateFee');
    }

    public function feeRange($fee)
    {
        session(compact('fee'));
        $page = session('page');
        $miles = session('miles');
        $this->slicer($page,$miles,$fee);
        return view('advisors.calculateFee');
    }

    public function resort($order = "sortByTotalFee")
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

        $page  = session('page');
        $miles = session('miles');
        $range = session('range');
        $fee   = session('fee');
        $max   = $range["max"];
        session(compact('advisors'));
        $this->slicer($page,$miles,$fee);  // needs $advisors in session
        session(compact('newOrder'));
        return view('advisors.calculateFee');
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

    public function entryForm (User $user) {
        return view('advisors.entry', compact('user'));
    }

    public function validating() {
        // Validate the form.  email checks email format
        $validation = $this->validate(request(), [
            'name'           => 'required|string|min:2',
            'email'          => 'required|string|email:unique:advisors',
            'zip'            => 'required|string|min:5',
            'feeCalculation' => 'required'
        ]);
        return $validation;
    }

    public function store(Request $request) {
        $validation = $this->validating();
        $data = $this->buildArray($request);
        $advisor = Advisor::create($data);

        $user = $advisor->user;
        $results = $user->updateId($advisor->id);
        $rates = $advisor->rate;

        // After creating your ADVISOR information, we need your RATES information
        return view('rates.edit', compact('advisor','rates'));
    }

    // this goes to the form to get new advisor information
    public function edit(Advisor $advisor) {
        return view('advisors.update', compact('advisor'));
    }

    public function update(Advisor $advisor) {
        $validation = $this->validating();
        //advisor has the old data, request has the new
        $data = $this->buildArray();
        $advisor->update($data);

        $rates = $advisor->rate;
        if ($rates->count()==0) {
            return view('rates.edit', compact('advisor','rates'));
        }

        // advisor.edit is in LoginController and AdvisorController
        $advisor = checkURLs($advisor);
        return view('advisors.edit', compact('advisor', 'rates'));

    }

    public function display(Advisor $advisor) {
        $advisor = checkURLs($advisor);
        $rates = $advisor->rate;
        // error message if no rates for this Advisor 
        if ($rates->count()==0) {
            return view('advisors.edit', compact('advisor', 'rates'))->withErrors(["msg" => "Need at least on entry for Rates"]);
        } else {
            return view('advisors.edit', compact('advisor', 'rates'));
        }
    }

    public function contact(Advisor $advisor) {
        return view('advisors.contact', compact('advisor'));
    }

    public function delete($id) {
//      Advisor::destroy($id);
        $results = User::where('id', $id)->delete();
        $results = Advisor::where('id', $id)->delete();
        $results = Rate::where("advisor_id",$id)->delete();
        return redirect('/admin/advisors/list')->with('status', "Advisor {$id} deleted!");
    }

    public function highlight($advisor, $findme="") {
        if($findme!="") {
            $len = strlen($findme);
            $pos = strpos(strtolower($advisor->name), strtolower($findme));
            if ($pos !== false) {
                $tmp=$advisor->name;
                $parts[0] = substr($tmp, 0, $pos);
                $parts[1] = "<span style='background-color:#" . HEX_HIGHLIGHT_COLOR . ";'>";
                $parts[2] = substr($tmp,$pos,$len);
                $parts[3] = "</span>";
                $parts[4] = substr($tmp,$pos+$len);
                $advisor->name = $parts[0] . $parts[1] . $parts[2] . $parts[3] . $parts[4];
            }
        }
        return $advisor;
    }

    public function search(Request $request) {
        $findme = request('search');
        // if null check sessions
        if ($findme == NULL) {
            if($request->session()->has('findme')) {
                $findme=session('findme');
            }
        } else {
            session(compact('findme'));
        }
// $request->session()->forget('findme'); on index
        $advisors = Advisor::where('name','like',"%$findme%")->orderBy('name','asc')->paginate(ROWS_PER_PAGE); //->orWhere('company', 'like', "%$target%" ) )->get();
        foreach($advisors as $advisor){
            $advisor = $this->highlight($advisor, $findme);
        }
        return view('advisors.index', compact('advisors','findme'));
    }
}
