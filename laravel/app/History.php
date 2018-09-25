<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;
use feeduciary\Signup;

class History extends Model
{

    protected $table = 'history';

    protected $fillable = [
        'zipcode', 'amount', 'signup_id'
    ];

	public function signup() {
		return $this->belongsTo(Signup::class);
	}

	public static function insertRecord($id, $zipcode, $amount) {
		if ($zipcode===null) $zipcode = 0;
		$history = Self::create(["signup_id"=>$id, "zipcode"=>$zipcode, "amount"=>$amount ]);
		return $history;
	}

    public function getAll() {
        return Self::select('zipcode','amount','signup_id','created_at')->get();
    }

    public function findId($id) {
    	return Self::find($id);
    }

    public function getRec($id) {
		$rec = \DB::table('history')
			->select('history.*','signups.name')
            ->leftJoin('signups', 'history.signup_id', '=', 'signups.id')
            ->where("history.id",$id)
            ->first();
        return $rec;
    }
}
