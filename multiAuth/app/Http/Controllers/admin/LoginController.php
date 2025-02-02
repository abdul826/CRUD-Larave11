<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    //This metod will show login page
    public function index(){
        return view('admin.login');
    }

    // Authenticate the Admin
    public function authenticate(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password' => $request->password])){
                if(Auth::guard('admin')->user()->role !='admin'){
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with("error","You are not authorized to access this page");
                }

                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->route('admin.login')->with("error","Either email or password is Invalid.");
            }
        }else{
            return redirect()->route('admin.login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    // Logout the user
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('account.login');
    }
}
