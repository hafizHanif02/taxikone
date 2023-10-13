<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;


class DriverController extends Controller
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
                $driver = User::where('is_driver',1)->get();
                return view('admin.driver', ['userData'=>$userData,'drivers'=>$driver]);
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
            'name' => $request->name,
            'email' => $request->email,
            'username'=> $request->username,
            'password' => Hash::make($request->password),
            'is_driver' => 1,
            'email_verified_at' => now(),
        ]);
        return redirect()->route('driver.index')->with(['message' => 'Driver Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        User::where(['id'=>$request->driver_id,'is_driver'=>1])->update([
            'name' => $request->name,
            'email' => $request->email,
            'username'=> $request->username,
            'is_driver' => 1,
        ]);
        return redirect()->route('driver.index')->with(['message' => 'Driver Edited']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Driver  $driver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::where(['id'=>$request->driver_id,'is_driver'=>1])->delete();
        return redirect()->route('driver.index')->with(['message' => 'Driver Deleted']);

    }
}
