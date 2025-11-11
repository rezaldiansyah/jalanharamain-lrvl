<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Itinerary extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'city',
        'days',
        'description',
        'is_active',
    ];

    protected $casts = [
        'days' => 'integer',
        'is_active' => 'boolean',
    ];

    public function stops(): HasMany
    {
        return $this->hasMany(ItineraryStop::class)->orderBy('day')->orderBy('sequence');
    }
}