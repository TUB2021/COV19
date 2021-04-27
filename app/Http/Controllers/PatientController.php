<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Patient;
class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $id = Auth::id();
            $patient = Patient::where('user_id', $id)->first();
            $patientHistory = Patient::where('user_id', $id)->get();
            $user = User::where('id', $id)->first();
            $tester = User::where('users.id', $patient->tester_id)
            ->select(
                'users.name', 
                'test_centers.name as test_center_name', 
              )
              ->join('testers', 'testers.user_id', '=', 'users.id')
              ->join('test_centers', 'test_centers.id', '=', 'testers.test_center_id')
              ->first();
            return view("patient.patienthistory", compact('patient', 'patientHistory','user', 'tester'));
        }catch(Exception $e){
            return $e;
        }
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
        $data = $request->input();
        try{
            Patient::create([
                'testID' => $data['testID'],
                'name' => $data['name'],
                'symptomps' => $data['symptomps'],
                'PatientType' => $data['PatientType'],
                'result' => $data['result'],
                'testDate' => $data['testDate'],
            ]);

            return back()
            ->with('status',"Test Added successfully")
            ->with('alert-class',"alert-success");
        }catch(Exception $e){
            return back()
            ->with('status',"Test Failed to Add")
            ->with('alert-class',"alert-danger");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $Patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $Patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $testKit
     * @return \Illuminate\Http\Response
     */
    public function edit(TestKit $Patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $Patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $Patient)
    {
        $data = $request->input();
        try{
            Patient::where('id', $data['id'])
            ->update([
                'testID' => $data['testID'],
                'name' => $data['name'],
                'symptomps' => $data['symptomps'],
                'PatientType' => $data['PatientType'],
                'result' => $data['result'],
                'testDate' => $data['testDate'],
                    ]);

            return back()
            ->with('status',"Test Updated successfully")
            ->with('alert-class',"alert-success");
        }catch(Exception $e){
            return back()
            ->with('status',"Test Failed to Update")
            ->with('alert-class',"alert-danger");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $Patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->input();
        try{
            Patient::where('id', $data['id'])
            ->delete();

            return back()
            ->with('status',"Test Updated successfully")
            ->with('alert-class',"alert-success");
        }catch(Exception $e){
            return back()
            ->with('status',"Test Failed to Update")
            ->with('alert-class',"alert-danger");
        }
    }
}

