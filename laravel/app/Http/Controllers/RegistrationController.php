<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class RegistrationController extends Controller
{
 
/* index, store, show, create, edit, update, destroy */

    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
 		return view('auth.register');
    }

 	public function store() {

 		// Validate the form.  email checks email format
 		$this->validate(request(), [
			'name'     => 'required|min:2',
			'email'    => 'required|email|unique:users',
			'password' => 'required|min:3|confirmed',
			'password_confirmation' => 'required|min:3'
 		]);

 		// Create and save the user
 		$hashed = Hash::make(request('password')); // or bcrypt($password)

 		$user = User::create([
			'name'     => request('name'),
			'email'    => request('email'),
			'password' => $hashed
		]);

 		// Sign them in
 		auth()->login($user);

 		// After creating your USER information, we need your ADVISOR information
        $state = $this->optionState();
        return view('advisors.entry', compact('user','state'));
 	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Just set active falf to false
    }

}
