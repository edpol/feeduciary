<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct() {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create() {
echo "this is supposed to call the view auth.login, not come here";
die();
        return view('sessions.create');
	}

    public function destroy() {
        auth()->logout();
        return redirect('/');
    }

    public function store() {
        // Authenticate user
        if (! auth()->attempt(request(['email','password']))) {
            return back();
        }
        return redirect('/');
    }
}
