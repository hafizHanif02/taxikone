<?php

namespace App\Http\Controllers;

use App\Models\distination;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DistinationController extends Controller
{
    public function showDestination(){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                $dest = distination::get();
                return view('admin.destination', ['userData'=>$userData, 'dest'=> $dest]);
            }
            if($userData->is_controller){
                $dest = distination::get();
                return view('controller.destination', ['userData'=>$userData, 'dest'=> $dest]);
            }
        }
    }

    public function addEditDeleteDestination(Request $request){
        
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                if($request->type == 'new'){
                    $newDest = new distination();
                    $newDest->name = $request->destinationName;
                    $newDest->address = $request->destinationAddress;
                    $newDest->save();
                }else if($request->type == 'update'){
                    $Dest = distination::where('id',$request->destID)->first();

                    if($Dest){
                        $Dest->name = $request->destinationName;
                        $Dest->address = $request->destinationAddress;
                        $Dest->save();
                        echo '<script>showToast("success", "Operation successful.");</script>';
                    }

                }else if($request->type == 'delete'){
                    $Dest = distination::where('id',$request->destID)->delete();
                }

                return redirect()->back();
            }
            return redirect('/destination');
        }
        return redirect('/login');
    }
}
