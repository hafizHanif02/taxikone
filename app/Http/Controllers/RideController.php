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

class RideController extends Controller
{
    public function showRides(){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                $destinations = distination::get();
                $hotels = hotel::get();
                $drivers = Driver::get();
                $rides = ride::with(['hotel','destination'])->get();
                return view('admin.rides', [
                    'userData'=>$userData,
                     'destinations'=> $destinations,
                     'hotels' => $hotels,
                     'rides' => $rides,
                     'drivers'=> $drivers,
                    ]);
            }
            return "asdfdsf";
        }
    }

    public function store(Request $request){
        ride::create([
            'customer_name' => $request->customer_name,
            'hotel_id' => $request->hotel_id,
            'destination_id' => $request->destination_id,
            'ride_date' => $request->ride_date,
            'ride_time' => $request->ride_time,
        ]);
        return redirect()->route('ride.index')->with(['message' => 'Ride Created']);
    }
}
