<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

