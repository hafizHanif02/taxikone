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
        return $this->belongsTo(Manager::class, 'manager_id'); // Use 'manager_id' as the foreign key
    }

    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class); // Assuming Driver is the related model, no need for a foreign key here
    }
}
