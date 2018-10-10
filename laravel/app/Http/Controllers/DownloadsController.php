<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use feeduciary\Advisor;
use feeduciary\Signup;
use feeduciary\History;

class DownloadsController extends Controller
{
	public $signup;

	public function __construct(Signup $signup) {
		$this->signup = $signup;
	}

	public function index($key="name", $downloaded=0) { 
		//get all of the rows from signup table
		$list = $this->getVerifiedSignup($key,$downloaded);
		return view("signup.downloads",compact("list","key","downloaded"));
	}

	public function getVerifiedSignup($key="name",$downloaded=0) {
		$array_of_objects="";
		if ($key=="updated") { $key="updated_at"; }
		try { 
			$perpage = ($downloaded==0) ? 100 : 100;
			$array_of_objects = Signup::where("verified",1)->where("downloaded",$downloaded)->orderBy($key)->paginate($perpage);
		} catch(\Illuminate\Database\QueryException $ex){ 
			dd($ex->getMessage()); 
		}
		return $array_of_objects;
	}

    public function create(Request $request, $update="n") {

    	$list = session('list');//request('check_list');
		$list = explode(",", $list);

    	// it at least sends 1 row, the header 
    	if(count($list)>0) {

			$headers = csvHeaders("signuplist.csv");

			$signup = $this->signup;

		    $callback = function() use ($list,$signup) {
		        $FH = fopen('php://output', 'w');

				$columns = array('email','name','zipcode');
		        fputcsv($FH, $columns);

		        for($i=0; $i<count($list); $i++) {
		        	$rec = $signup->findId($list[$i]);
		        	$array = ["email"=>$rec->email, "name"=>$rec->name, "zipcode"=>$rec->zipcode];
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
			$rec = $this->signup->findId($list[$i]);
			if ($rec->downloaded == 0) {
				$rec->downloaded = 1;
				$rec->save();
			}
		}
		return;
	}

    //	save all the id's in a session var
    //	goto blank page, send link to page /signup/csv/create/yes or no
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
		    $refresh = url("/signup/csv/create/" . $update);
		    $back = url("/signup/download");
	//	    session(['list' => $id_list]);
			// this is supposed to last for one request
			$request->session()->flash('list', $id_list);	    
		    return view('layouts.blank',compact("refresh","back")); // goes to countdown page to start download
    	} else {
    		return redirect('/signup/download')->withErrors(['No Emails to Download']);
    	}

	}

   /*
    *	Get all of the advisors, the view will checkmark active advisors
    */
	public function getAdvisors() {
		$list = "";
		$advisors = new Advisor();
		$list = $advisors->getAll(); //name email phone company

	   	if(count($list)>0) {
			$headers = csvHeaders("AdvisorsList.csv");

		    $callback = function() use ($list) {
		        $FH = fopen('php://output', 'w');

				$columns = array('name','email','phone','company','active');
		        fputcsv($FH, $columns);
		        foreach($list as $rec) {
		        	$array = $rec->toArray();
			        fputcsv($FH, $array);
		        }
		        fclose($FH);
		    };
			return response()->stream($callback, 200, $headers);
	    } else {
	    	return "List empty";
	    }
	}

	public function getHistory(History $history) {
		$list = "";
		$list = $history->getAll();

	   	if(count($list)>0) {
			$headers = csvHeaders("HistoryList.csv");

		    $callback = function() use ($list) {
		        $FH = fopen('php://output', 'w');

				$columns = array('zipcode','amount','signup_id','created_at');
		        fputcsv($FH, $columns);
		        foreach($list as $rec) {
		        	$array = $rec->toArray();
			        fputcsv($FH, $array);
		        }
		        fclose($FH);
		    };
			return response()->stream($callback, 200, $headers);
	    } else {
	    	return "List empty";
	    }
	}

}
