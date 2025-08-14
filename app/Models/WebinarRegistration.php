<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    protected $fillable = [
        'webinar_id', // tambah relasi ke webinar
        'name',
        'gender', 
        'email',
        'whatsapp',
        'city',
        'source',
    ];
    
    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}