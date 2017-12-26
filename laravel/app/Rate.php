<?php

namespace feeduciary;

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

    public static function doesRateExist($advisor_id,$roof) {
        $checkRate = self::where("advisor_id",$advisor_id)->where("roof",$roof)->orderBy('roof', 'DESC')->get();
        return $checkRate;
    }
}
