<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\Signup;
use feeduciary\Http\Controllers\Controller;
use feeduciary\Mail;
use feeduciary\Mail\ContactUs;
use feeduciary\Mail\Message;
use feeduciary\Mail\Welcome;
use feeduciary\Mail\Verification;

class SignupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



/*

lookup email, if exists
    if verified 
        save email cookie
        goto results
    else
        ask if they want us to resend email
            send verification email
        or change the email address
            call the popup window to get email address (put it in it's own file so you can include it in both places)
else
    call the popup window to get email address
        save in DB
        save in cookie
        send verification email
 */


    /**
     *  lookup email
     *  if exists display window resend or change
     *  else
     *    add to DB
     *    email verification email with token
     */
    public function save2DB(Request $request) {
        $number_of_bytes = 64;
        $token = bin2hex(random_bytes($number_of_bytes));

        //  if the email does not exist, add it?
        // what if there are 2 people using the same address?
        // maybe i should change the email key to unique
        $signup = Signup::where("email",$email)->first();
        $count = (is_null($signup)) ? 0 : $signup->count();
        if ($count==0) {
            $data = [
                    'name'   => htmlentities(request('name')),
                    'email'  => htmlentities(request('email')),
                    'token'  => $token,
                    'subject'=> 'Email verification',
                    "server_name" => env('APP_URL'),
                    ];

            // add to DB
            $signup = Signup::create($data);

            // send email
            \Mail::to($data['email'],$data['name'])->send(new Verification($data));

        } else {
        // display window resend or change
        }
        return $signup;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'  => 'string|max:50',
            'email' => 'required|email',
        ]);
        $signup = $this->save2DB($request);
        $data = ['name'   => htmlentities(request('name')),
                 'email'  => htmlentities(request('email'))];
        return view('casual.thankYou', ['data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \feeduciary\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function show(Signup $signup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \feeduciary\Signup   
     * @return \Illuminate\Http\Response
     */
    public function edit(Signup $signup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \feeduciary\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Signup $signup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \feeduciary\Signup  $signup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signup $signup)
    {
        //
    }
}
