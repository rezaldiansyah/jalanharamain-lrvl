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
        'category',
        'description',
        'image',
        'destination',
        'duration_days',
        'price',
        'agent_fee',
        'agent_fee_type',
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
        'agent_fee' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function travelPartner()
    {
        return $this->belongsTo(TravelPartner::class);
    }

    // Helper method untuk mendapatkan label kategori
    public function getCategoryLabelAttribute()
    {
        $categories = [
            'umroh' => 'Umroh',
            'haji_khusus' => 'Haji Khusus',
            'wisata_halal' => 'Wisata Halal',
            'lainnya' => 'Lainnya'
        ];

        return $categories[$this->category] ?? 'Tidak Diketahui';
    }

    // Helper method untuk mendapatkan semua kategori
    public static function getCategories()
    {
        return [
            'umroh' => 'Umroh',
            'haji_khusus' => 'Haji Khusus',
            'wisata_halal' => 'Wisata Halal',
            'lainnya' => 'Lainnya'
        ];
    }
}