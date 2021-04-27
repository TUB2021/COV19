<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\TestCenter;
use App\Tester;
use Auth;

class TestOfficerController extends Controller
{
    public function index(Request $request){
        $user = User::where('id', Auth::id())->first();
        if($user->role == "tester"){
            $tester = Tester::where("user_id", Auth::id())->first();
            $testCenter = TestCenter::where('id', $tester->test_center_id)->first();
            $patient = Patient::where([
                ["patients.test_location_id", $tester->test_center_id],
            ])
            ->join('users', 'users.id', 'patients.user_id')
            ->select('users.name', 'users.email', 'patients.*')
            ->orderBy('user_id', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
            return view("testCenterOfficer.index", compact('patient', 'testCenter'));
        }else if($user->role == "testCenterManager"){
            $patient = Patient::join('users', 'users.id', 'patients.user_id')
            ->select('users.name', 'users.email', 'patients.*')
            ->orderBy('user_id', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();
            return view("testCenterOfficer.index", compact('patient'));
        }

        return "ini test officer";        
    }
}
