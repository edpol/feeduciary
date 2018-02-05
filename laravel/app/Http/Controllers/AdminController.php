<?php

namespace feeduciary\Http\Controllers;

use feeduciary\Rate;
use feeduciary\Advisor;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advisors = Advisor::paginate(10); //all();
        return view('advisors.index', compact('advisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $advisor = Advisor::where('id',$id)->first();
        if ($advisor->is_active) {
            $data["button"] = "Deactivate Advisor";
            $data["buttonColor"] = "red";
            $data["backgroundColor"] = null;
        } else {
            $data["button"] = "Activate Advisor";
            $data["buttonColor"] = "green";
            $data["backgroundColor"] = "#fee";
        }
        $rates = $advisor->rate;
        return view('advisors.edit', compact('advisor','rates','data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function inactive($id)
    {
        $advisor=Advisor::where('id',$id)->first();
        $advisor->is_active=!$advisor->is_active;
        $advisor->save();
        return redirect("/admin/advisors/{$id}");
    }
}
