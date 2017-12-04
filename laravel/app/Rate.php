<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'roof', 'rate', 'advisor_id'
    ];

	public function advisor() {
		return $this->belongsTo(Advisor::class);
	}

   public function user() {
    	return $this->belongsTo(User::class);
    }

}
