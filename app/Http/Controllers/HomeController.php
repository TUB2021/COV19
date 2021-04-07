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
        if(Auth::user()->checkRole() == 'student'){
          return redirect('student');
        }else if(Auth::user()->checkRole() == 'university'){
          return redirect('university');
        }else{
          return redirect('sasadmin');
        }
    }
}
