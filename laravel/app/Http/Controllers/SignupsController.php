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
use feeduciary\Mail\VerificationWelcome;

class SignupsController extends Controller
{

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

// if they exist i shouldn't generate new token, put it in buildArray

        $email = htmlentities(request('email'));
        $name  = htmlentities(request('name'));

        //  check that the email address is not already in the Signup table
        $signup = new Signup();
        $signup = $signup->checkTableSignupForEmail($email,$found_in_DB);

        $data = $this->buildArray($request,$signup->token);

       /*
        *   (1) New Guest
        */
        if (!$found_in_DB || $email!=$signup->email) {
            $signup = $signup->processNewRecord($data);
        } else {
            if ($signup->verified) {
               /*
                *   (2) Verified
                */
                $response = $this->storeCookie($signup->id,$email,$name,$signup->verified);

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
                if ($name!=$signup->name) {
                    // if name is different update name in DB
                    $signup->name = $name;
                    $signup->save();
                }
            }
        }
        $response = $this->storeCookie($signup->id,$email,$name,$signup->verified);

        // send email
        $data['scheme'] = scheme();
        \Mail::to($data['email'],$data['name'])->send(new Verification($data));

        return redirect('/signup/thankyou')->with('email',$email)
                                           ->with('name',$name)
                                           ->with('verified',$signup->verified);
/*                               is this a route or view?
        return response()->view('checkout/order', compact('plans', 'selectedPlan', 'right_now'))
        ->withCookie(Cookie::forever('store_currency', $currency));
*/
    } 

    public function storeCookie($id, $email, $name, $verified) {
        $v = ($verified==true) ? 1 : 0;
        $array = ["id"=>$id,"email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>$v];
        $string = json_encode($array);
        $response = new Response('Added Cookie ' . COOKIE_NAME);
        // with queue the cookie is set when you leave controller
        Cookie::queue(Cookie::forever(COOKIE_NAME, $string));
        return $response;
    }

    public function buildArray(Request $request,$token_maybe) {
        $number_of_bytes = 64;
        $token = (is_null($token_maybe)) ? bin2hex(random_bytes($number_of_bytes)) : $token_maybe;
        return [
            'name'    => htmlentities(request('name')),
            'email'   => htmlentities(request('email')),
            'token'   => $token,
            'amount'  => htmlentities(request('amount')),
            'zipcode' => htmlentities(request('zipcode')),
            'subject' => 'Email verification',
            'server_name' => env('APP_URL'),
        ]; 
    }

    public function thankyou() {
        $name  = session('name');
        $email = session('email');
        $verified = session('verified');
        return view('signup.thankyou', compact('name','email','verified'));
    }

    // verifying email address
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

        $data['subject'] = "Address verified";
        \Mail::to($signup->email,$signup->name)->send(new VerificationWelcome($data));

        return redirect('/')->with('email',$signup->email)
                            ->with('name',$signup->name)
                            ->with('verified',$signup->verified)
                            ->with('zipcode',$signup->zipcode)
                            ->with('fb_pixel_lead',1);
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
        $fb_pixel_lead = session('fb_pixel_lead');

        /* null, true, false 
        i think if there is an entry in the database, we should get it and override the cookie
        but, why is the cookie changing? 
        */
        return view('casual.index',compact('verified','email','name','fb_pixel_lead'));

    }



}
