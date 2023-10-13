<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $userData = Auth::user();

            if($userData->is_admin){
                $managers = User::where('is_controller',1)->get();
                return view('admin.managers', ['userData'=>$userData,'managers'=>$managers]);
            }
            return "asdfdsf";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'is_controller' => '1',
           'email_verified_at' => now(),
        ]);
        return redirect()->route('managers.index')->with(['message' => 'Manager Created']);

    }

    public function update(Request $request){
        User::where('id',$request->id)->update([
            'name'=> $request->name,
            'email'=> $request->email,
            'username'=> $request->username,
            'is_controller' => '1',
           'email_verified_at' => now(),
        ]);
        return redirect()->route('managers.index')->with(['message' => 'Manager Update']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Manager $manager)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        User::where('id',$request->manager_id)->delete();
        return redirect()->route('managers.index')->with(['message' => 'Manager Deleted']);

    }
}
