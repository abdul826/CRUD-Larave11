<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // This function run once User successfully login 
    public function index(){
        return view('dashboard');
    }
}
