<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItineraryStop extends Model
{
    protected $fillable = [
        'itinerary_id',
        'day',
        'sequence',
        'poi_id',
        'custom_name',
        'notes',
        'start_time',
        'end_time',
        'lat',
        'lng',
    ];

    protected $casts = [
        'day' => 'integer',
        'sequence' => 'integer',
        'lat' => 'float',
        'lng' => 'float',
    ];

    public function itinerary(): BelongsTo
    {
        return $this->belongsTo(Itinerary::class);
    }

    public function poi(): BelongsTo
    {
        return $this->belongsTo(Poi::class);
    }
}