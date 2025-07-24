<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CalagenEbook extends Model
{
    use HasFactory;

    protected $table = 'calagen_ebook';

    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan', 
        'kota_domisili',
        'email',
        'username',
        'password',
        'nomor_whatsapp',
        'jenis_kelamin',
        'is_converted_to_user'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_converted_to_user' => 'boolean',
    ];

    public function convertToUser()
    {
        if ($this->is_converted_to_user) {
            return null; // Sudah dikonversi sebelumnya
        }

        $user = User::create([
            'name' => $this->nama_lengkap,
            'email' => $this->email,
            'password' => $this->password, // Password sudah di-hash
            'role' => 'calon-agen'
        ]);

        $this->update(['is_converted_to_user' => true]);

        return $user;
    }
}
