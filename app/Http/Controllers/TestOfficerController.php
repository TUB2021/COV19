<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestOfficerController extends Controller
{
    public function index(Request $request){
        return "ini test officer";
    }
}
