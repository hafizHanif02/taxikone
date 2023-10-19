<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'manager_id',
        'address',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id'); // Use 'manager_id' as the foreign key
    }



    public function drivers(): HasMany
    {
        return $this->hasMany(User::class); // Assuming Driver is the related model, no need for a foreign key here
    }

    public function rides(): HasMany
    {
        return $this->hasMany(ride::class, 'hotel_id'); // Assuming Driver is the related model, no need for a foreign key here
    }

    public function ridesCount()
    {
        return $this->rides->count(); // Assuming Driver is the related model, no need for a foreign key here
    }

}
