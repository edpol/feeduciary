<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use feeduciary\Http\Requests;
use feeduciary\Http\Controllers\Controller;

class CookieController extends Controller
{
	public function getAll() {
		$cookies = Cookie::get();
		var_dump($cookies);
		dd();
	}

	public function setCookie($email, $name="") {
		$data = ["email"=>htmlentities($email), "name"=>htmlentities($name), "verified"=>false];
		$response = $this->store(COOKIE_NAME,$data);
		return $response;
	}

	public function getCookie($cookie) {
		$value = request()->cookie($cookie);
		$value = json_decode($value,true);
		return $value;
	}

	public function foundCookie() {
		$value = $this->show(COOKIE_NAME);
		return is_null($value) ? false : true;
	}
//---------------------------------------------------------------------------------------

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
// cookie()->queue($name, $value, $minutes);
// Cookie::queue($name, $value, $minutes);
// response('Added Cookie '.$cookie)->withCookie(cookie()->forever($cookie,json_encode($data)));
	}

	/*
	 *	if ask for email 
	 */
	public function index() {

		//	do you have a cookie, normal 
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
