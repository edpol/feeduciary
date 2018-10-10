<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;
use feeduciary\History;

class HistoryController extends Controller
{
	public $history;

	public function __construct(History $history) {
		$this->history = $history;
	}

	public function index($key="zipcode", $downloaded=0) { 
		//get all of the rows from history table
		$perpage = 100;
//		select h.zipcode, h.amount, h.signup_id, s.name from history as h left join signups as s on h.signup_id=s.id where downloaded=0:1
		if($key=="name") {
			$table = "signups";
		} else {
			$table = "history";
		}
//			'history.downloaded', 'history.id', 'history.zipcode', 'history.amount', 'history.signup_id', 'signups.name'
		$list = \DB::table('history')
			->select('history.*','signups.name')
            ->leftJoin('signups', 'history.signup_id', '=', 'signups.id')
            ->where("history.downloaded",$downloaded)
            ->orderBy("{$table}.{$key}")->paginate($perpage);

		return view("history.downloads",compact("list","key","downloaded"));
	}
	//sorts by history zipcode
	//displays history zipcode

    //	goto blank page, send link to page /history/csv/create/yes or no
    public function list(Request $request) {
    	$list = request('check_list');
    	$update = strtolower(request('update'));
    	$id_list = "";
    	if(count($list)>0) {
	        foreach ($list as $row) { 
	        	$array = explode(",",$row);
	        	$id_list .= "," . $array[0];
	  		}
	  		$id_list = substr($id_list, 1);
		    $refresh = url("/history/csv/create/" . $update);
		    $back = url("/history/download");
	//	    session(['list' => $id_list]);
			// this is supposed to last for one request
			$request->session()->flash('list', $id_list);		 // save the contents $id_list in variable list in sessions
		    return view('layouts.blank',compact("refresh","back")); // goes to countdown page to start download
    	} else {
    		return redirect('/history/download')->withErrors(['No Emails to Download']);
    	}

	}

    public function create(Request $request, $update="n") {

    	$list = session('list');//request('check_list');
		$list = explode(",", $list);

    	// it at least sends 1 row, the header 
    	if(count($list)>0) {

			$headers = csvHeaders("historylist.csv");

			$history = $this->history;

		    $callback = function() use ($list,$history) {
		        $FH = fopen('php://output', 'w');

				$columns = array('zipcode','amount','signup ID', 'name');
		        fputcsv($FH, $columns);

				// i am reading from the table a second time, how do i save the original query?
		        for($i=0; $i<count($list); $i++) {
		        	$rec = $history->getRec($list[$i]); 
		        	$array = ["zipcode"=>$rec->zipcode, "amount"=>$rec->amount, "signup_id"=>$rec->signup_id, "name"=>$rec->name ];
			        fputcsv($FH, $array);
		        }
		        fclose($FH);
		    };

		    if ($update=="y") {
		    	$this->updateDownloaded($list);
	    	}

			return response()->stream($callback, 200, $headers);
		} else {
			return "List empty";
		}
	}

	private function updateDownloaded($list) {
		for($i=0; $i<count($list); $i++) {
			$rec = $this->history->findId($list[$i]);
			if ($rec->downloaded == 0) {
				$rec->downloaded = 1;
				$rec->save();
			}
		}
		return;
	}



}
