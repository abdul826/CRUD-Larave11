<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     // This function run once User successfully login 
     public function index(){
        return view('admin.dashboard');
    }
} 
