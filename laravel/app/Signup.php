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
}
