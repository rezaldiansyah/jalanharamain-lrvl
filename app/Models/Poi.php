<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poi extends Model
{
    protected $table = 'pois';

    protected $fillable = [
        'name',
        'slug',
        'category',
        'city',
        'lat',
        'lng',
        'address',
        'description',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'is_active' => 'boolean',
    ];
}