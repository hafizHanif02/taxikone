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
            }else if($userData->is_controller){
                
            $hotels = hotel::where('manager_id',$userData->id)->with('manager')->get();
            $manager = Manager::where('id',$userData->id)->first();
            // dd($manager);
                return view('controller.hotels', [
                    'userData'=>$userData, 
                    'hotels' => $hotels,
                    // 'manager' => $manager,
                ]);
            }
            
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
            'user_id' => $request->user_id,
        ]);
        return redirect()->route('hotels')->with(['message' => 'Hotel Created']);

    }

    public function delete($hotelID){
        hotel::where('id',$hotelID)->delete();
        return redirect()->route('hotels')->with(['message' => 'Hotel Deleted']);
    }

    public function myhotels(Request $request){
        // dd($request);
        if(Auth::check()){
            $userData = Auth::user();
            $hotels = hotel::where('manager_id',$userData->id)->with('manager')->get();
            $manager = Manager::where('id',$request->user_id)->first();
            // dd($manager);
                return view('controller.hotels', [
                    'userData'=>$userData, 
                    'hotels' => $hotels,
                    // 'manager' => $manager,
                ]);
            
            return "asdfdsf";
        }
    }
}
