<?php

namespace feeduciary;

use Illuminate\Database\Eloquent\Model;

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

}
