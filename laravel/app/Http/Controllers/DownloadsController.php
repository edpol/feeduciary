<?php

namespace feeduciary\Http\Controllers;

use Cookie;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use feeduciary\Signup;

class DownloadsController extends Controller
{

	public function index($key="name", $done=0) { 
		//get all of the rows from signup table
		$list = $this->getVerified($key,$done);
		return view("signup.downloads",compact("list","key","done"));
	}

	public function getVerified($key="name",$done=0) {
		$array_of_objects="";
		if ($key=="updated") { $key="updated_at"; }
		try { 
			if ($done==1) {
				$array_of_objects = Signup::where("verified",1)->where("downloaded",1)->orderBy($key)->paginate(50); //->get();
			} else {
				$array_of_objects = Signup::where("verified",1)->where("downloaded",0)->orderBy($key)->get();
			}
		} catch(\Illuminate\Database\QueryException $ex){ 
			dd($ex->getMessage()); 
		}
		return $array_of_objects;
	}

    public function create(Request $request, $update="n") {

    	$list = session('list');//request('check_list');
		$list = explode(",", $list);

//		if ($update=='Y') $this->update($request);

	    $headers = [
	            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
	        ,   'Content-type'        => 'text/csv'
	        ,   'Content-Disposition' => 'attachment; filename=signuplist.csv'
	        ,   'Expires'             => '0'
	        ,   'Pragma'              => 'public'
	    ];

    	// it at least sends 1 row, the header 
    	if(count($list)>0) {

		    $callback = function() use ($list,$update) 
		    {
		        $FH = fopen('php://output', 'w');

				$columns = array('email','name');
		        fputcsv($FH, $columns);

		        for($i=0; $i<count($list); $i++) {
		        	$rec = Signup::find($list[$i]);
		        	$array = ["email"=>$rec->email, "name"=>$rec->name];
			        fputcsv($FH, $array);
			        if ($update=="y" && $rec->downloaded == 0) {
			            $rec->downloaded = 1;
		    	        $rec->save();
		  			}
		        }
		        fclose($FH);
		    };

		    return response()->stream($callback, 200, $headers);
	    } else {
	    	echo "List empty";
	    }
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
}
