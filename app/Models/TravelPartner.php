<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPartner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'contact_person',
        'phone',
        'email',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function travelPackages()
    {
        return $this->hasMany(TravelPackage::class);
    }
}