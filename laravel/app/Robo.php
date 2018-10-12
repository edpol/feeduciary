<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;

class Robo extends Model
{

	protected $fillable = ['advisor_id', 'is_robo'];

    public function advisor()
    {
        return $this->belongsTo(Advisor::class);
    }

    // this looks for an admin column in your users table
    public function isRobo() {
        if ($this->is_robo) {
            return true;
        } else { 
            return false;
        }
    }


}
