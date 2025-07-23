<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'travel_partner_id',
        'name',
        'description',
        'destination',
        'duration_days',
        'price',
        'start_date',
        'end_date',
        'max_participants',
        'itinerary',
        'includes',
        'excludes',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function travelPartner()
    {
        return $this->belongsTo(TravelPartner::class);
    }
}