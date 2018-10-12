<?php

namespace feeduciary\Http\Controllers;

use feeduciary\Rate;
use feeduciary\User;
use feeduciary\Robo;
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

   /*
    *   check if there is a robo entry
    *   if it does not create a record, set to true
    *   else if check mark set 
    */
    public function robo(Request $request, $id)
    {
        $checkbox = request(['robo']);

        // Retrieve by advisor_id, or instantiate...
        $robo = Robo::firstOrNew(['advisor_id'=>$id]);
        $robo->is_robo = (count($checkbox)==0) ? false : true;
        $robo->save();

        return redirect("/admin/advisor/{$id}");
    }

    public function inactive($id)
    {
        $advisor=Advisor::where('id',$id)->first();
        $advisor->is_active=!$advisor->is_active;
        $advisor->save();
//$this->show($id);
        return redirect("/admin/advisor/{$id}");
    }


    public function delete($id) {
//      Advisor::destroy($id);
        $user    = User::where('id', $id)->delete();
        $advisor = Advisor::where('id', $id)->delete();
        $rate    = Rate::where("advisor_id",$id)->delete();
        return redirect('/admin/advisors/list')->with('status', "Advisor {$id} deleted!");
    }
}
