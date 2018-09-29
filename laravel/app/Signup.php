<?php

namespace feeduciary;

use Cookie;
use feeduciary\History;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $fillable = ['name', 'email', 'verified', 'token', 'zipcode'];

    public function history() {
        return $this->hasMany(History::class);
    }

   // this looks for an admin column in your users table
    public function isVerified() {
        if ($this->verified) {
            return true;
        } else { 
            return false;
        }
    }

    public function findId($id) {
    	return Self::find($id);
    }

    public function getVerified($downloaded, $key, $paginate=1000) {
		return Self::where("verified",1)->where("downloaded",$downloaded)->orderBy($key)->paginate($paginate);
	}

    public function checkTableSignupForEmail($email,&$found) {
        try { 
            $signup = Self::where("email",$email)->first();
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

    public function processNewRecord($data) {
        // add to DB
        $data['zipcode'] = getZipcode();
        $signup = Self::create($data);
        return $signup;
    }

    public function saveCookie($id, $email, $name, $zipcode, $verified) {
        $v = ($verified==true) ? 1 : 0;
        if ($id===null) $id = 0;
        if ($zipcode===null) $zipcode = ' ';
        $array = ["id"=>$id, "email"=>htmlentities($email), "name"=>htmlentities($name), "zipcode"=>$zipcode, "verified"=>$v];
        $string = json_encode($array);
        $response = new Response('Added Cookie ' . COOKIE_NAME);
        // with queue the cookie is set when you leave controller
        Cookie::queue(Cookie::forever(COOKIE_NAME, $string));
        return $response;
    }

}
