<?php

namespace App\Models;

use App\Models\hotel;
use App\Models\Driver;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ride extends Model
{
    use HasFactory;

    protected $dates = ['ride_date'];

    protected $fillable = [
        'customer_name',
        'ride_date',
        'hotel_id',
        'destination_id',
        'comission_rate',
        'driver_id',
        'driver_paid',
        'hotel_paid',
        'cost',
    ];

    public function hotel(){
        return $this->belongsTo(hotel::class);
    }
    public function destination(){
        return $this->belongsTo(distination::class,'destination_id');
    }
    public function driver(){
        return $this->belongsTo(User::class,'driver_id');
    }
}
