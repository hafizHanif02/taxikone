<?php

namespace App\Http\Controllers;

use App\Models\hotel;
use App\Models\commission;
use App\Models\distination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
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
                $commission = commission::with('hotel')->get();
                $hotel = hotel::get();
                $distination = distination::get();
                return view('admin.comission', [
                    'userData'=>$userData,
                    'commissions'=> $commission,
                    'hotels'=> $hotel,
                    'distinations'=> $distination,
                    
                    ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy(commission $commission)
    {
        //
    }
}
