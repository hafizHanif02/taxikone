<?php

namespace App\Models;

use App\Models\hotel;
use App\Models\distination;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class commission extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'destination_id',
        'comission_rate',
        'cost',
    ];


    public function hotel(): BelongsTo
    {
        return $this->belongsTo(hotel::class);
    }


    public function destination(): BelongsTo
    {
        return $this->belongsTo(distination::class);
    }
}
