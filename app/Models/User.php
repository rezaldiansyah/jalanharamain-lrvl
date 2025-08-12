<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCalagenAgen()
    {
        return $this->role === 'calon-agen';
    }

    public function isAgen()
    {
        return $this->role === 'agen';
    }

    // Tambahan method untuk role travel
    public function isTravel()
    {
        return $this->role === 'travel';
    }

    public function canAccessEbook()
    {
        return in_array($this->role, ['calon-agen', 'agen']);
    }

    // Relasi dengan travel partner
    public function travelPartner()
    {
        return $this->hasOne(TravelPartner::class);
    }
}
