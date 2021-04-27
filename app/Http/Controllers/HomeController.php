<?php

namespace App\Http\Controllers;
use Auth;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(Auth::user()->checkRole() == 'tester'){
        return redirect('tester');
      }else if(Auth::user()->checkRole() == 'patient'){
        return redirect('patient');
      }else{
        return redirect('testCenterOfficer');
      }
    }
}
