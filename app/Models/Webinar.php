<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Webinar extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'subtitle', 'slug', 'description', 'date', 'time', 'platform',
        'meeting_link', 'max_participants', 'template', 'status',
        'is_free', 'price', 'custom_content'
    ];
    
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'is_free' => 'boolean',
        'custom_content' => 'array'
    ];
    
    public function registrations()
    {
        return $this->hasMany(WebinarRegistration::class);
    }
    
    // Generate slug otomatis
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($webinar) {
            $webinar->slug = static::generateSlug($webinar);
        });
    }
    
    public static function generateSlug($webinar)
    {
        $type = $webinar->is_free ? 'free' : 'paid';
        $date = $webinar->date->format('Ymd');
        $baseSlug = "webinar/{$type}/{$date}";
        
        // Jika ada duplikat, tambahkan nomor
        $slug = $baseSlug;
        $counter = 1;
        while (static::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    // Method untuk mendapatkan URL publik
    public function getPublicUrl()
    {
        return url($this->slug);
    }
}