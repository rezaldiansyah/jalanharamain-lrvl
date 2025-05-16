<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebinarRegistration extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'email',
        'whatsapp',
        'city',
        'source',
    ];
}