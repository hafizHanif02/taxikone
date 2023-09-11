<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function show(hotel $hotel){
        if(Auth::check()){
            $userData = Auth::user();

            if($userData->is_admin){
                $hotels = hotel::get();
                return view('admin.hotels', ['userData'=>$userData, 'hotels' => $hotels]);
            }
            return "asdfdsf";
        }
    }
}
