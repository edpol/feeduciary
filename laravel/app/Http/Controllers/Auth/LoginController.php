<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Rate;
use App\Advisor;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/update';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout')->except('update');
    }

    /* index, store, show, create, edit, update, destroy */

    public function update() {
        $msg = "";
        // grab record from USER Table
        $user = Auth::user();

        // use user->id to get record from ADVISOR table
        // if there is no advisor entry, go to advisor entry page
        $advisor = Advisor::where("user_id",$user->id)->first();
        $count = (is_null($advisor)) ? 0 : $advisor->count();
        if ($count==0) {
            $state = $this->optionState();
            return view('advisors.entry', compact('user','state'));
        }

        // use advisor->id to search for a RATES entry
        // if there is no rates entry, go to rates entry
        $rates = $advisor->rate;
        if ($rates->count()==0) {
            return view('rates.edit', compact('advisor', 'msg', 'rates'));
        }

        // advisor.edit is in LoginController and AdvisorController
        return view('advisors.edit', compact('advisor', 'rates'));

    }

}
