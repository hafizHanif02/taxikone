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
                $drivers = User::where('is_driver',1)->get();
                $rides = ride::with(['hotel','destination','driver'])->get();

                $topDriver = ride::groupBy('driver_id')->selectRaw('count(driver_id) as count, driver_id')->orderby('count', 'desc')->first();

                $topDist = ride::groupBy('destination_id')->selectRaw('count(destination_id) as count, destination_id')->orderby('count', 'desc')->first();
                $topHotel = ride::groupBy('hotel_id')->selectRaw('count(hotel_id) as count, hotel_id')->orderby('count', 'desc')->first();

                //ModelName::groupBy('group_id')->selectRaw('count(*) as total, group_id')->get();

                return view('admin.rides', [
                    'userData'=>$userData,
                     'destinations'=> $destinations,
                     'hotels' => $hotels,
                     'rides' => $rides,
                     'drivers'=> $drivers,
                     'topDriver'=> $topDriver,
                     'topDist' => $topDist,
                     'topHotel' => $topHotel
                    ]);
            }
            elseif($userData->is_controller){
                $hotelIds = hotel::where('user_id',$userData->id)->pluck('id');
                $destinations = distination::get();
                $hotels = hotel::where('user_id',$userData->id)->get();
                $drivers = User::where('is_driver',1)->get();
                $rides = ride::whereIn('hotel_id',$hotelIds)->with(['hotel','destination','driver'])->get();
                return view('controller.rides', [
                    'userData'=>$userData,
                     'destinations'=> $destinations,
                     'hotels' => $hotels,
                     'rides' => $rides,
                     'drivers'=> $drivers,
                    ]);
            }
        }
    }

    public function myshowRides(Request $request){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_controller == 1){
                $hotelIds = hotel::where('user_id',$request->user_id)->pluck('id');
                $destinations = distination::get();
                $hotels = hotel::where('user_id',$request->user_id)->get();
                $drivers = User::where('is_driver',1)->get();
                $rides = ride::whereIn('hotel_id',$hotelIds)->with(['hotel','destination','driver'])->get();
                return view('controller.rides', [
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
            'driver_id' => $request->driver_id,
            'hotel_id' => $request->hotel_id,
            'destination_id' => $request->destination_id,
            'ride_date' => $request->ride_date,
            'comission_rate' => $request->comission_rate,
        ]);
        return redirect()->route('ride.index')->with(['message' => 'Ride Created']);
    }
}
