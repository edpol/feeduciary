<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
	public $cookie_name = "email";

	public function setCookie2($email, $name="") {
		$data = ["email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>false];
 		$array_json=json_encode($data);
		return redirect('/')->withCookie(cookie()->forever($this->cookie_name,$array_json));
	}

	public function setCookie($email, $name="") {
		$data = ["email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>false];
		$response = $this->store($this->cookie_name,$data);
		return $response;
	}

	public function foundCookie() {
		$value = $this->show($this->cookie_name);
		return is_null($value) ? false : true;
	}
//----------------------------------------------------------------------------------------------------

	public function show($cookie_name) {
		$value = request()->cookie($cookie_name);
		if (gettype($value)=="string") {
			$value = json_decode($value,true);
		}
		return $value;
	}

	public function clear($cookie_name) {
		$cookie = Cookie::forget($cookie_name);
		return response('forgot cookie '.$cookie_name)->withCookie($cookie);
	}

	public function store($cookie_name, $data) {
		$response = new Response('Added Cookie '.$cookie_name);
		$response->withCookie(cookie()->forever($cookie_name,json_encode($data)));
		return $response;
//		return response('Added Cookie '.$cookie_name)->withCookie(cookie()->forever($cookie_name,json_encode($data)));
	}

	/*
	 *	if ask for email 
	 */
	public function index() {

//session(['signedUp'=>5]);

		$ask_for_email = true;

		//	are you signed in , normal
		if (auth()->check()) $ask_for_email = false;

		//	do you have a cookie, normal 
		if ($this->foundCookie()) $ask_for_email = false;

		//	save a flag for the other pages to access
		$this->store('ask_for_email',$ask_for_email);

		//	send to popup window on submit
		return view('casual.index');

	}

}
