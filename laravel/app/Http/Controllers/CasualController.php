<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

class CasualController extends Controller
{

    public function about () {
    	return view ('casual.about');
    }

    public function blog () {
    	return view ('casual.blog');
    }

}
