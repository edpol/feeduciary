<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
/*
        // only the index method has to have an authorized user (user logged in)
        $this->middleware('auth', ['only' => 'index']);
        $this->middleware('auth')->only(['index']);

        // all methods in this controller need to have an authorized user EXCEPT index
        $this->middleware('auth', ['except' => 'index']);
*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/');
    }
}
