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

    // Tambahan method untuk role management
    public function isCalagenAgen()
    {
        return $this->role === 'calon-agen';
    }

    public function isAgen()
    {
        return $this->role === 'agen';
    }

    // 2. Update Model User untuk Method canAccessEbook()
    public function canAccessEbook()
    {
        return in_array($this->role, ['calon-agen', 'agen']);
    }
}
