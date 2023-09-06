<?php

namespace App\Http\Controllers;

use App\Models\permission;
use App\Models\role_permission;
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
                $roles = role_permission::get();
                return view('admin.permission', ['userData'=>$userData, 'roles'=> $roles]);
            }
            return "asdfdsf";
        }
    }

    public function addPermission(Request $request){
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                if($request->type == 'new'){
                    $newRole = new role_permission();
                    $newRole->name = $request->roleName;
                    $newRole->description = $request->roleName;
                    $newRole->save();
                }else if($request->type == 'update'){
                    $role = role_permission::find($request->roleId);
                    if($role){
                        $role->name = $request->name;
                        $role->save();
                    }

                }

                return redirect()->back();
            }
            return redirect('/dashboard');
        }
        return redirect('/login');
    }
}
