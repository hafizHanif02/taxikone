<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\hotel;

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
                $hotels = hotel::with('manager')->withCount('rides')->get();
                
                $managers = User::where('is_controller',1)->get();
                return view('admin.hotels', [
                    'userData'=>$userData,
                    'hotels' => $hotels,
                    'managers'=> $managers
                ]);
            }else if($userData->is_controller){

            $hotels = hotel::where('user_id',$userData->id)->with('manager')->get();
            $manager = User::where('id',$userData->id)->first();
                return view('controller.hotels', [
                    'userData'=>$userData,
                    'hotels' => $hotels,
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
            $hotels = hotel::where('user_id',$userData->id)->with('manager')->get();
                return view('controller.hotels', [
                    'userData'=>$userData,
                    'hotels' => $hotels,
                ]);

            return "asdfdsf";
        }
    }

    public function update(Request $request){
        hotel::where('id',$request->hotelID)->update([
            'name' => $request->hotelName,
            'address' => $request->address,
        ]);
        return redirect()->route('hotels')->with(['message' => 'Hotel Updated']);
    }
}
