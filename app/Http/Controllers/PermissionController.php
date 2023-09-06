<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function showPermission(){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                return view('admin.permission', ['userData'=>$userData]);
            }
            return "asdfdsf";
        }
    }
}
