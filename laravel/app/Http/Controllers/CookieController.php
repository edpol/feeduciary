<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
	public $cookie_name;

	public function __construct() {
		$this->cookie_name = env('COOKIE_NAME','signup');
	}

	public function getAll() {
		$cookies = Cookie::get();
		var_dump($cookies);
		dd();
	}

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

	public function showCookie($cookie) {
		$data = $this->show($cookie);
		var_dump($data);
		dd();
	}

	public function foundCookie() {
		$value = $this->show($this->cookie_name);
		return is_null($value) ? false : true;
	}
//-------------------------------------------------------------------------------------------

	public function show($cookie) {
		$signup = request()->cookie($cookie);
		if (gettype($signup)=="string") {
			$signup = json_decode($signup,false);
		}
		return $signup;
	}

	public function clear($cookie) {
		$cookie = Cookie::forget($cookie);
		return response('forgot cookie '.$cookie)->withCookie($cookie);
	}

	public function store($cookie, $data) {
		$response = new Response('Added Cookie '.$cookie);
		$response->withCookie(cookie()->forever($cookie,json_encode($data)));
		return $response;
//		return response('Added Cookie '.$cookie)->withCookie(cookie()->forever($cookie,json_encode($data)));
	}

	/*
	 *	if ask for email 
	 */
	public function index() {

		//	do you have a cookie, normal 
		$signup = $this->show($this->cookie_name);
		$verified = "";
		$email = "";
		$name = "";
		if (!is_null($signup) && gettype($signup)=="object" && !is_null($signup->verified)) {
			$verified = ($signup->verified==1) ? true : false;
			$email = $signup->email;
			$name = $signup->name;
		}
		/* null, true, false */

		return view('casual.index',compact('verified','email','name'));

	}

}
