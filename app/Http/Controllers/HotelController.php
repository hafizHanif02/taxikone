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
                $hotels = hotel::with('manager')->get();
                $managers = Manager::all(); 
                return view('admin.hotels', [
                    'userData'=>$userData, 
                    'hotels' => $hotels,
                    'managers'=> $managers
                ]);
            }
            return "asdfdsf";
        }
    }

    // public function create(){
    //     if(Auth::check()){
    //         $userData = Auth::user();

    //         if($userData->is_admin){
    //             return view('hotel.create', [
    //                 'userData'=>$userData,
    //                 'managers' => Manager::all(),
    //             ]);
    //         }
    //     }
    //     return "asdfdsf";
    // }

    public function store(Request $request){
        // return $request;
        hotel::create([
            'name' => $request->hotelName,
            'address' => $request->address,
            'manager_id' => $request->manager_id,
        ]);
        return redirect()->route('hotels')->with(['message' => 'Hotel Created']);

    }

    public function delete($hotelID){
        hotel::where('id',$hotelID)->delete();
        return redirect()->route('hotels')->with(['message' => 'Hotel Deleted']);
    }

    public function myhotels($controller){
        if(Auth::check()){
            $userData = Auth::user();
                $hotels = hotel::where('manager_id',$controller)->with('manager')->get();
                return view('admin.hotels', [
                    'userData'=>$userData, 
                    'hotels' => $hotels,
                ]);
            
            return "asdfdsf";
        }
    }
}
