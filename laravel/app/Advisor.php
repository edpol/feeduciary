<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Advisor extends Model
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    // the user_id connects the advisor to the user table. virtual fk
    protected $fillable = ['is_active', 'name', 'phone', 'email', 'company', 'address1', 'address2', 'city', 'st', 'zip', 'url', 'minimum_amt', 'maximum_amt', 'minimum_fee', 'feeCalculation', 'lat', 'lng', 'brochure', 'bio', 'user_id', 'facebook', 'finraBrokercheck', 'linkedin', 'twitter', 'discretionaryAUM', 'feeCalculation'
    ];

    // we call this with feeduciary\Task::incomplete1();
    public static function activeAdvisors() {
        return static::where('is_active', 1)->get();
    }

    public function rate() {
    	return $this->hasMany(Rate::class)->orderBy('roof', 'DESC');
		// Comment::class will return the namespace of the Comment class, i.e. ('feeduciary\Comment');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function robo() {
        return $this->hasOne(Robo::class);
    }

    public function photo() {
        if (file_exists( public_path() . '/images/advisorImages/' . $this->id . '-thumb.jpg')) {
            return '/images/advisorImages/' . $this->id .'-thumb.jpg';
        } else {
            return '/images/placeholder.png';
        }
    }

   /*
    *   Is person logged in the owner of this account
    */
    public function owner() {
        $user = Auth::user();
        if ($user->id == $this->user_id) {
            return true;
        } else {
            return false;
        }
    }

    public function targetSearch($search_string) {
        return self::where('name', 'like', $search_string.'%')->get();
    }

    public function getAll() {
        return self::select('name', 'email', 'phone', 'company', 'is_active')->get();
    }

}
