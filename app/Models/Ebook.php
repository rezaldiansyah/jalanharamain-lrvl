<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'file_name',
        'file_path',
        'bunny_url',
        'file_size',
        'is_active'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGratis($query)
    {
        return $query->where('category', 'gratis');
    }

    public function scopeBerbayar($query)
    {
        return $query->where('category', 'berbayar');
    }
}
