<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use Auth;
use Illuminate\Support\Facades\Hash;

class TesterController extends Controller
{
    public function index(Request $request){
        $patient = User::where('role', 'patient')->get();
        return view("tester.recordTest", compact('patient'));
    }

    public function addNewTest(Request $request){
        $data = $request->input();
        try{
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => "patient"
            ]);

            $patientData = Patient::create([
                'user_id' => $user->id,
                'tester_id' => Auth::id(),
                'patient_type' => $data['patientType'],
                'symptomps'  => $data['symptomps'],
                'status'  => 'pending'
            ]);

            return back()
                ->with('status',"New Test Added successfully")
                ->with('alert-class',"alert-success");
            }catch(Exception $e){
            return back()
                ->with('status',"New Test Failed to Add")
                ->with('alert-class',"alert-danger");
            }
    }

    public function patienthistory($id){
        try{
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
            return view("tester.patienthistory", compact('patient', 'patientHistory','user', 'tester'));
        }catch(Exception $e){
            return $e;
        }
    }

    public function updatePatient(Request $request){
        $data = $request->input();
        try{
            $user = User::where('id', $data['user_id'])
            ->update(
                [
                    'name' => $data['name'],
                    'email' => $data['email']
                ]
            );

            return back()
                ->with('status',"Patient Updated successfully")
                ->with('alert-class',"alert-success");
            }catch(Exception $e){
            return back()
                ->with('status',"Patient Failed to Update")
                ->with('alert-class',"alert-danger");
            }
    }

    public function updateTestRecord(Request $request){
        $data = $request->input();
        try{
            $patientData = Patient::create([
                'user_id' => $data['user_id'],
                'tester_id' => Auth::id(),
                'patient_type' => $data['patientType'],
                'symptomps'  => $data['symptomps'],
                'status'  => $data['status']
            ]);

            return back()
                ->with('status',"Test Record Updated successfully")
                ->with('alert-class',"alert-success");
            }catch(Exception $e){
            return back()
                ->with('status',"Test Record Failed to Update")
                ->with('alert-class',"alert-danger");
            }
    }

    public function deleteTestRecord(Request $request)
    {
        $data = $request->input();
        try{
            Patient::where('user_id', $data['id'])
            ->delete();

            User::where('id', $data['id'])
            ->delete();

            return back()
            ->with('status',"Test Record deleted successfully")
            ->with('alert-class',"alert-success");
        }catch(Exception $e){
            return back()
            ->with('status',"Test Record Failed to delete")
            ->with('alert-class',"alert-danger");
        }
    }
  
}
