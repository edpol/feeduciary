<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Rate;

use App\Advisor;

class AdvisorsController extends Controller
{
    //
    public function index()
    {
        $advisors = Advisor::all();
        return view('advisors.index', compact('advisors'));
    }

    //
    public function show(Advisor $advisor)
    {
        return view('advisors.show', compact('advisor'));
    }

    /*
     *  sort by totalFee
     */
    private function bubble_sort($list) {
        $once=true;
        $limit = sizeof($list)-1;
        while ($once) {
            $once=false;
            for ($i=0; $i<$limit; $i++) {
                $j=$i+1;
                if ($list[$j]["totalFee"]<$list[$i]["totalFee"]) {
                    $temp = $list[$j];
                    $list[$j] = $list[$i];
                    $list[$i] = $temp;
                    $once = true;
                }
            }
        }
        return $list;
    }

    /*
     *  Calculate the advisors fee
     */
    private function advisorFee ($advisor, $amount, $zipcode) {

        $rate_list = Rate::where("advisor_id",$advisor->id)->orderBy('roof','ASC')->get();
        $investment = (float)$amount["amount"];
        $base = (float) 0;
        $floor = (float) 0;
        $charge = (float) 0;
        $totalFee = (float) 0;

        foreach ($rate_list as $row) {
            $roof = (float) $row["roof"];
            $rate = (float) $row["rate"];

            if ($advisor->feeCalculation == 0) {
                if ($investment >= $roof) {
                    $base = ($roof-$floor);
                    $charge = ($roof-$floor)*$rate;
                } else if (($investment-$floor)>0) {
                    $base = ($investment-$floor);
                    $charge = ($investment-$floor)*$rate;
                } else {
                    $base = 0;
                    $charge = 0;
                }
                $totalFee += $charge;
                $floor = $roof;
            }
            if ($advisor->feeCalculation == 1) {
                if ($investment >= $floor) {
                    $charge = $investment * $rate;
                    $floor = $roof;
                }
                $totalFee = $charge;
                $base = $investment;
            }
        }
        return $totalFee;
    }    

    public function calculateFee () {
        $this->validate(request(), ['amount'=>'required']);
        $amount = request(['amount']);
        $zipcode = request(['zipcode']);
        $advisors = Advisor::where("minimum_amt", "<", $amount)->get();
//      $advisors = Advisor::where("minimum_amt", "<", $amount)->simplePaginate(15);

//      var_dump($advisor->rates);
        $list = array();
        foreach ($advisors as $advisor) {
            $list[] = [ "id"=>$advisor->id, "totalFee"=>$this->advisorFee($advisor,$amount,$zipcode), "advisor"=>$advisor];
        }
        $final_list = $this->bubble_sort($list);

        return view('advisors.calculateFee', compact('amount', 'zipcode', 'final_list'));
    }
}
