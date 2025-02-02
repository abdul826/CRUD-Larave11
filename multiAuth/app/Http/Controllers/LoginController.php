<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    //Show login page for users
    public function index(){
        return view('login');
    }

    // Authenticate the user
    public function authenticate(Request $request){
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->passes()){
            if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
                return redirect()->route('account.dashboard');
            }else{
                return redirect()->route('account.login')->with("error","Either email or password is Invalid.");
            }
        }else{
            return redirect()->route('account.login')
            ->withInput()
            ->withErrors($validator);
        }
    }

    // Register the user
    public function register(Request $request){
        return view('register');
    }

    public function processRegister(Request $request){
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:5',
            'password_confirmation' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'customer';
            $user->save();

            return redirect()->route('account.login')->with('success', "You have registered successfully");

        }else{
            return redirect()->route('account.register')
            ->withInput()
            ->withErrors($validator);
        }
    }

    // Logout the user
    public function logout(){
        Auth::logout();
        return redirect()->route('account.login');
    }
}
