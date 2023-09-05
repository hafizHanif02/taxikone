<?php

namespace App\Http\Controllers;

use App\Models\ride;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RideController extends Controller
{
    public function showRides(){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                return view('admin.rides', ['userData'=>$userData]);
            }
            return "asdfdsf";
        }
    }
}
