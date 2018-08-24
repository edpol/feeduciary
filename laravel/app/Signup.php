<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
    protected $fillable = ['name', 'email', 'verified', 'token'];

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
}
