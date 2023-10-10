<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect()->intended('/dashboard'); // Redirect to the intended page
        }
        return view('login');
    }

    public function userLogin(Request $request){


        // Validate the login data
        $request->validate([
            'userName' => 'required',
            'password' => 'required',
        ]);

        // $user = new User();
        // $user->name = 'Admin';
        // $user->username = $request->input('userName');
        // $user->email = '';
        // $user->email_verified_at = now();
        // $user->password = Hash::make($request->input('password')); // Hash the password
        // $user->save();

        // Attempt to log the user in
        if (Auth::attempt(['username' => $request->userName, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->intended('/dashboard'); // Redirect to the intended page
        }

        // Authentication failed
        return back()->withErrors(['userName' => 'Invalid credentials'])->withInput($request->only('userName'));
    }

    public function dashboard(Request $request){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                return view('admin.dashboard', ['userData'=>$userData]);
            }
            elseif($userData->is_controller == 1){
                return view('controller.dashboard', ['userData'=>$userData]);
            }
        }
        return "asdfdsf";
    }
}
