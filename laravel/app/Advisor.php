<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_active', 'name', 'phone', 'email', 'company', 'address1', 'address2', 'city', 'st', 'zip', 'url', 'minimum_amt', 'maximum_amt', 'minimum_fee', 'feeCalculation', 'lat', 'lng', 'brochure', 'blurb', 'user_id'
    ];

    // we call this with App\Task::incomplete1();
    public static function allAdvisors() {
        return static::where('is_active', 1)->get();
    }

    public function rate() {
    	return $this->hasMany(Rate::class);
		// Comment::class will return the namespace of the Comment class, i.e. ('App\Comment');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    /*
     *  if the url is missing the http:// string, prepend it
     *  we can also add whatever is supplied in the scheme parameter
     */
    public static function addScheme($url, $scheme = 'http://') {
        return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
    }

}
