<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use feeduciary\Http\Requests;
use feeduciary\Http\Controllers\Controller;
use feeduciary\Signup;
use feeduciary\Mail;
use feeduciary\Mail\Verification;

class SignupsController extends Controller
{
    public $cookie_name;

    public function __construct() {
        $this->cookie_name = COOKIE_NAME;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //  validate
        $validatedData = $request->validate([
            'name'  => 'string|max:50',
            'email' => 'required|email',
        ]);

// if they exist i shouldnt use new token
// howe should i handle this? put it here or in buildArray

        $email = htmlentities(request('email'));
        $name  = htmlentities(request('name'));

        //  check that the email address is not already in the Signup table
        $signup = $this->checkTableSignupForEmail($email,$found_in_DB);

        $data = $this->buildArray($request,$found_in_DB);
        if ($found_in_DB) $data['token']=$signup->token;

        // Store cookie - we would not be here if we found the cookie
        $response = $this->storeCookie($email,$name,$signup->verified);

       /*
        *   (1) New Guest
        */
        if (!$found_in_DB) {
            $results = $this->processNewRecord($data);
        } else {
            if ($signup->verified) {
               /*
                *   (2) Verified
                */
               if (isset($data['amount']) && $data['amount']>0) {
                    $amount = $data['amount'];
                } else {
                    return redirect('/');                    
                }
               if (isset($data['zipcode'])) {
                    $zipcode = $data['zipcode'];
                } else {
                    $zipcode = "";
                }
                return redirect('/calculateFee')->with('amount',  $amount)
                                                ->with('zipcode', $zipcode);
            } else {
               /*
                *   (3) NOT Verified
                */
                if ($email!=$signup->email) {
                    // if email is different add a new record
                    $results = $this->processNewRecord($data);
                } else {

                    if ($name!=$signup->name) {
                        // if name is different update name in DB
                        $signup->name = $name;
                        $signup->save();
                    }
                }
            }
        }

        // send email
        \Mail::to($data['email'],$data['name'])->send(new Verification($data));

        return redirect('/signup/thankyou')->with('email',$email)
                                           ->with('name',$name)
                                           ->with('verified',$signup->verified);
/*                               is this a route or view?
        return response()->view('checkout/order', compact('plans', 'selectedPlan', 'right_now'))
        ->withCookie(Cookie::forever('store_currency', $currency));
*/
    } 

    public function storeCookie($email, $name, $verified) {
        $v = ($verified==true) ? 1 : 0;
        $array = ["email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>$v];
        $string = json_encode($array);
        $response = new Response('Added Cookie ' . COOKIE_NAME);
        // with queue the cookie is set when you leave controller
        Cookie::queue(Cookie::forever(COOKIE_NAME, $string));
        return $response;
    }

    public function processNewRecord($data) {
        // add to DB
        $signup = Signup::create($data);
        return;
    }

    public function buildArray(Request $request) {
        $number_of_bytes = 64;
        return [
            'name'    => htmlentities(request('name')),
            'email'   => htmlentities(request('email')),
            'token'   => bin2hex(random_bytes($number_of_bytes)),
            'amount'  => htmlentities(request('amount')),
            'zipcode' => htmlentities(request('zipcode')),
            'subject' => 'Email verification',
            'server_name' => env('APP_URL'),
        ]; 
    }

    public function checkTableSignupForEmail($email,&$found) {
        try { 
            $signup = Signup::where("email",$email)->first();
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
        }   
        $found = true;
        if(is_null($signup)) {
            $found = false;
            $signup = new Signup();
            $signup->verified = false;
        }
        return $signup;
    }

    public function thankyou() {
        $name  = session('name');
        $email = session('email');
        $verified = session('verified');
        return view('signup.thankyou', compact('name','email','verified'));
    }

    public function update($token) {
        try { 
            $signup = Signup::where("token",$token)->first();
        } catch(\Illuminate\Database\QueryException $ex){ 
            dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
        }   
        // if the token is not found we need an error message and ask them to register again
        if(is_null($signup)) {
            return view('signup.notfound',['token'=>$token]);
        }

        // if it is found update the verification flag in the database and cookie
        $signup->verified = true;
        $signup->save();

        // update cookie 
        $response = $this->storeCookie($signup->email,$signup->name,true);

        return redirect('/')->with('email',$signup->email)
                            ->with('name',$signup->name)
                            ->with('verified',$signup->verified);
    }

    public function show($cookie) {
        $signup = request()->cookie($cookie);
        if (gettype($signup)=="string") {
            $signup = json_decode($signup,false);
        }
        return $signup;
    }

    public function index() {

        //  do you have a cookie, normal 
        $signup = $this->show(COOKIE_NAME);
        $verified = "";
        $email = "";
        $name = "";
        if (!is_null($signup) && gettype($signup)=="object" && !is_null($signup->verified)) {
            $verified = ($signup->verified==1) ? true : false;
            $email = $signup->email;
            $name = $signup->name;
        }
        /* null, true, false 
        i think if there is an entry in the database, we should get it and override the cookie
        but, why is the cookie changing? 
        */
        return view('casual.index',compact('verified','email','name'));

    }



}
