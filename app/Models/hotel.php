<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class hotel extends Model
{
    use HasFactory;
   
    
}


// function manager(): BelongsTo
// {
//     return $this->belongsTo(Manager::class, 'coach_id');
// };

// function drivers(): HasMany
// {
//     return $this->belongsTo(Drivers::class, 'coach_id');
// };


