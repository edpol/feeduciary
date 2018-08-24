<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use feeduciary\Advisor;
use feeduciary\Signup;

class DownloadsController extends Controller
{

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


	public function getVerified($key="name",$downloaded=0) {
		$array_of_objects="";
		if ($key=="updated") { $key="updated_at"; }
		try { 
			$perpage = ($downloaded==0) ? 10 : 10;
			$signup = new Signup; 
			$array_of_objects = $signup->getVerified($downloaded, $key); // where do we paginate here ???

		} catch(\Illuminate\Database\QueryException $ex) { 
			dd($ex->getMessage()); 
		}
		return $array_of_objects;
	}

    public function create(Request $request, $update="n") {

    	$list = session('list');//request('check_list');
		$list = explode(",", $list);

    	// it at least sends 1 row, the header 
    	if(count($list)>0) {

			$headers = $this->buildHeaders("signuplist.csv");

			$signup = new Signup;
		    $callback = function() use ($list,$signup) {
		        $FH = fopen('php://output', 'w');

				$columns = array('email','name');
		        fputcsv($FH, $columns);

		        for($i=0; $i<count($list); $i++) {
		        	$rec = $signup->findId($list[$i]);
		        	$array = ["email"=>$rec->email, "name"=>$rec->name];
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

    private function buildHeaders($outfile) {
		$headers = [
	            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
	        ,   'Content-type'        => 'text/csv'
	        ,   'Content-Disposition' => "attachment; filename={$outfile}"
	        ,   'Expires'             => '0'
	        ,   'Pragma'              => 'public'
	    	];
		return $headers;
	}

	private function updateDownloaded($list) {
		$signup = new Signup; 
		for($i=0; $i<count($list); $i++) {
			$rec = $signup->findId($list[$i]);
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
    	$output = "";
    	if(count($list)>0) {
	        foreach ($list as $row) { 
	        	$array = explode(",",$row);
	        	$output .= "," . $array[0];
	  		}
	  		$output = substr($output, 1);
		    $link = url("/signup/csv/create/" . $update);
		    $back = url("/signup/download");
	//	    session(['list' => $output]);
			// this is supposed to last for one request
			$request->session()->flash('list', $output);	    
		    return view('signup.blank',compact("link","back"));
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
			$headers = $this->buildHeaders("AdvisorsList.csv");

		    $callback = function() use ($list) {
		        $FH = fopen('php://output', 'w');

				$columns = array('email','name');
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
