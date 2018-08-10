<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use feeduciary\Signup;
use feeduciary\Mail;
use feeduciary\Mail\Verification;

class SignupsController extends Controller
{
    public $cookie_name;

    public function __construct() {
        $this->cookie_name = env('COOKIE_NAME','signup');
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
               if (isset($data['amount'])) {
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

//        return $response; // this works
//        return redirect()->route('thankyou', ['name'=>$name]);
    } 

    public function storeCookie($email, $name, $verified) {
        $data = ["email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>$verified];
        $response = new Response('Added Cookie '.$this->cookie_name);
        // with queue the cookie is set when you leave controller
        Cookie::queue($this->cookie_name, json_encode($data), 525600);
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
        $email = request()->session()->get('email');
        $verified = request()->session()->get('verified');
        $email_sent = request()->session()->get('email_sent');
        return view('signup.thankyou', compact('name','email','verified','email_sent'));
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
        $cookie = $this->show($this->cookie_name);
        $response = $this->storeCookie($cookie['email'],$cookie['name'],true);

        return redirect('/');
    }


    public function show($cookie) {
        $signup = request()->cookie($cookie);
        if (gettype($signup)=="string") {
            $signup = json_decode($signup,false);
        }
        return $signup;
    }
}
