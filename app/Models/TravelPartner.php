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
        'ppiu_number',
        'pihk_number',
        'user_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function travelPackages()
    {
        return $this->hasMany(TravelPackage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}