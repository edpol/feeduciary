<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advisor extends Model
{
    // we call this with App\Task::incomplete1();
    public static function allAdvisors()
    {
        return static::where('is_active', 1)->get();
    }

    public function rates() {
    	return $this->hasMany(Rate::class);
		// Comment::class will return the namespace of the Comment class, i.e. ('App\Comment');
    }

}
