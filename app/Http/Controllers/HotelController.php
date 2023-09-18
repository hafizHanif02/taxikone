<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\hotel;
use App\Models\Manager;

use Illuminate\Http\Request;
use App\Http\Requests\HotelRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HotelController extends Controller
{
    public function show(hotel $hotel){
        if(Auth::check()){
            $userData = Auth::user();

            if($userData->is_admin){
                $hotels = hotel::get();
                $managers = Manager::all(); 
                return view('admin.hotels', ['userData'=>$userData, 'hotels' => $hotels,'managers'=> $managers]);
            }
            return "asdfdsf";
        }
    }

    public function store(HotelRequest $hotel){
        hotel::create($hotel->validate());

        return redirect()->route('hotels')->with(['message' => 'Hotel Created']);

    }
}
