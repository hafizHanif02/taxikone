<?php

namespace App\Http\Controllers;

use App\Models\ride;
use App\Models\hotel;
use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotelDataAll = ride::select(
            DB::raw('hotel_id as hotel_id'),
            DB::raw('COUNT(*) as number_of_rides'),
            DB::raw('SUM(comission_rate) as total_commission'),
        )
        ->groupBy('hotel_id')->with('hotel')->get();

        $hotelPayAll = ride::select(
            DB::raw('hotel_id as hotel_id'),
            DB::raw('COUNT(*) as number_of_rides'),
            DB::raw('SUM(comission_rate) as total_commission'),
        )
        ->groupBy('hotel_id')->where(['hotel_paid' => 0])->with('hotel')->get();


        $hotelDataPayable = ride::select(
            DB::raw('hotel_id as hotel_id'),
            DB::raw('COUNT(*) as number_of_rides'),
            DB::raw('SUM(comission_rate) as total_commission'),
        )
        ->groupBy('hotel_id')->where(['hotel_paid' => 0,'driver_paid' => 1])->with('hotel')->get();

        foreach($hotelDataAll as $allData){
            $isFound = false;
            $isFound2 = false;
            foreach($hotelDataPayable as $payableData){

                if($allData->hotel_id == $payableData->hotel_id){
                    $allData->payable_amount = $payableData->total_commission;
                    $allData->payable_ride = $payableData->number_of_rides;
                    $isFound = true;
                    break;
                }
            }
            if(!$isFound){
                $allData->payable_amount = '0';
                $allData->payable_ride = '0';
            }

            foreach($hotelPayAll as $payData){
                if($allData->hotel_id == $payData->hotel_id){
                    $allData->pay_amount = $payData->total_commission;
                    $allData->pay_ride = $payData->number_of_rides;
                    $isFound2 = true;
                    break;
                }
            }
            if(!$isFound2){
                $allData->pay_amount = '0';
                $allData->pay_ride = '0';
            }
        }

        $driverDataAll = ride::select(
            DB::raw('driver_id as driver_id'),
            DB::raw('COUNT(*) as number_of_rides'),
            DB::raw('SUM(comission_rate) as total_commission'),
        )
        ->groupBy('driver_id')->with('driver')->get();

        $driverDataPaid = ride::select(
            DB::raw('driver_id as driver_id'),
            DB::raw('COUNT(*) as number_of_rides'),
            DB::raw('SUM(comission_rate) as total_commission'),
        )
        ->groupBy('driver_id')->where(['driver_paid' => 1])->with('driver')->get();

        foreach($driverDataAll as $driverAll){
            $isFound = false;
            foreach($driverDataPaid as $driverPaid){
                if($driverAll->driver_id == $driverPaid->driver_id){
                    $driverAll->balance_comission = $driverAll->total_commission -  $driverPaid->total_commission;
                    $isFound = true;
                    break;
                }
            }
            if(!$isFound){
                $driverAll->balance_comission = '0';
            }
        }
        // dd($hotelData);
        if(Auth::check()){
            $userData = Auth::user();
            if($userData->is_admin){
                return view('admin.payment', [
                    'userData'=>$userData,
                    'hotelDatas'=>$hotelDataAll,
                    'driverDatas'=>$driverDataAll,
                    ]);
            }
            elseif($userData->is_controller){
                    $hotelIds = hotel::where('manager_id', $userData->id)->pluck('id');
                    $hotelDataAll = ride::whereIn('hotel_id',$hotelIds)->select(
                        DB::raw('hotel_id as hotel_id'),
                        DB::raw('COUNT(*) as number_of_rides'),
                        DB::raw('SUM(comission_rate) as total_commission'),
                        )
                        ->groupBy('hotel_id')->with('hotel')->get();

                    $hotelPayAll = ride::whereIn('hotel_id',$hotelIds)->select(
                        DB::raw('hotel_id as hotel_id'),
                        DB::raw('COUNT(*) as number_of_rides'),
                        DB::raw('SUM(comission_rate) as total_commission'),
                    )
                    ->groupBy('hotel_id')->where(['hotel_paid' => 0])->with('hotel')->get();


                    $hotelDataPayable = ride::whereIn('hotel_id',$hotelIds)->select(
                        DB::raw('hotel_id as hotel_id'),
                        DB::raw('COUNT(*) as number_of_rides'),
                        DB::raw('SUM(comission_rate) as total_commission'),
                    )
                    ->groupBy('hotel_id')->where(['hotel_paid' => 0,'driver_paid' => 1])->with('hotel')->get();

                    foreach($hotelDataAll as $allData){
                        $isFound = false;
                        $isFound2 = false;
                        foreach($hotelDataPayable as $payableData){
                            if($allData->hotel_id == $payableData->hotel_id){
                                $allData->payable_amount = $payableData->total_commission;
                                $allData->payable_ride = $payableData->number_of_rides;
                                $isFound = true;
                                break;
                            }
                        }
                        if(!$isFound){
                            $allData->payable_amount = '0';
                            $allData->payable_ride = '0';
                        }

                        foreach($hotelPayAll as $payData){
                            if($allData->hotel_id == $payData->hotel_id){
                                $allData->pay_amount = $payData->total_commission;
                                $allData->pay_ride = $payData->number_of_rides;
                                $isFound2 = true;
                                break;
                            }
                        }
                        if(!$isFound2){
                            $allData->pay_amount = '0';
                            $allData->pay_ride = '0';
                        }
                    }

                    $driverDataAll = ride::whereIn('hotel_id',$hotelIds)->select(
                        DB::raw('driver_id as driver_id'),
                        DB::raw('COUNT(*) as number_of_rides'),
                        DB::raw('SUM(comission_rate) as total_commission'),
                    )
                    ->groupBy('driver_id')->with('driver')->get();

                    $driverDataPaid = ride::whereIn('hotel_id',$hotelIds)->select(
                        DB::raw('driver_id as driver_id'),
                        DB::raw('COUNT(*) as number_of_rides'),
                        DB::raw('SUM(comission_rate) as total_commission'),
                    )
                    ->groupBy('driver_id')->where(['driver_paid' => 1])->with('driver')->get();

                    foreach($driverDataAll as $driverAll){
                        $isFound = false;
                        foreach($driverDataPaid as $driverPaid){
                            if($driverAll->driver_id == $driverPaid->driver_id){
                                $driverAll->balance_comission = $driverAll->total_commission -  $driverPaid->total_commission;
                                $isFound = true;
                                break;
                            }
                        }
                        if(!$isFound){
                            $driverAll->balance_comission = '0';
                        }
                    }
                    return view('controller.payment', [
                        'userData'=>$userData,
                        'hotelDatas'=>$hotelDataAll,
                        'driverDatas'=>$driverDataAll,
                        ]);
             }

        }
    }


    public function addpay(Request $request){
        ride::where(['driver_id' => $request->id, 'driver_paid' => 0 ])->update([
            'driver_paid' => 1
        ]);
        return redirect()->route('payment.index')->with(['message' => 'Payments Created']);
    }
    public function addpayController(Request $request){
        ride::where(['driver_id' => $request->id, 'driver_paid' => 0 ])->update([
            'driver_paid' => 1
        ]);
        return redirect()->route('dashboard')->with(['message' => 'Payments Created']);
    }

    public function addpayhotel(Request $request){
        // dd($request);
        ride::where(['hotel_id' => $request->id, 'hotel_paid' => 0 ,'driver_paid'=>1])->update([
            'hotel_paid' => 1
        ]);
        return redirect()->route('payment.index')->with(['message' => 'Payments Created']);
    }
    public function addpayhotelController(Request $request){
        ride::where(['hotel_id' => $request->id, 'hotel_paid' => 0 ,'driver_paid'=>1])->update([
            'hotel_paid' => 1
        ]);

        return redirect()->route('payment.index')->with(['message' => 'Payments Created']);
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
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(payment $payment)
    {
        //
    }
}
