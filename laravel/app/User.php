<?php

namespace feeduciary;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'advisor_id', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rates() {
        return $this->hasMany(Rate::class);
    }

    public function advisor() {
        return $this->belongsTo(Advisor::class);
    }

    // this looks for an admin column in your users table
    public function isAdmin() {
        if (auth()->check() && $this->admin) {
            return true;
        } else { 
            return false;
        }
    }

    // $user->advisor_id = $id
    public function updateId($id) {
        $result = $this->update(['advisor_id' => $id]);
    }

}
