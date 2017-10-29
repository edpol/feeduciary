<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CasualController extends Controller
{

    public function index () {
    	return view ('casual.index');
    }

    public function about () {
    	return view ('casual.about');
    }

    public function blog () {
    	return view ('casual.blog');
    }

    public function contact () {
    	return view ('casual.contact');
    }

}
