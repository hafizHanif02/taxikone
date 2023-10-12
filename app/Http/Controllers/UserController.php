<?php

namespace App\Http\Controllers;
use App\Models\ride;
use App\Models\User;
use App\Models\hotel;

use App\Models\Driver;
use App\Models\distination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            $rides = count(ride::get());
            $hotels = count(hotel::get());
            $distinations = count(distination::get());
            $drivers = count(Driver::get());
            if($userData->is_admin){
                return view('admin.dashboard', [
                    'userData'=>$userData,
                    'rides'=>$rides,
                    'hotels'=>$hotels,
                    'distinations'=>$distinations,
                    'drivers'=>$drivers,
                ]);
            }
            elseif($userData->is_controller == 1){
                $hotelIds = hotel::where('user_id',$userData->id)->pluck('id');
            $rides = count(ride::whereIn('hotel_id',$hotelIds)->get());
            $hotels = count(hotel::whereIn('id',$hotelIds)->get());
            $distinations = count(distination::get());
            $drivers = count(Driver::get());
                return view('controller.dashboard', [
                    'userData'=>$userData,
                    'rides'=>$rides,
                    'hotels'=>$hotels,
                    'distinations'=>$distinations,
                    'drivers'=>$drivers,
                ]);
            }
        }
        return "asdfdsf";
    }
}
