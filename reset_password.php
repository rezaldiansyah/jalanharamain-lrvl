<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Cari user berdasarkan email
$user = App\Models\User::where('email', 'raldiansyah339@gmail.com')->first();

// Cek apakah user ditemukan
if ($user) {
    echo "User ditemukan: " . $user->name . "\n";
    echo "Role: " . $user->role . "\n";
    
    // Reset password ke password baru
    $user->password = Hash::make('bismillah');
    $user->save();
    
    echo "Password berhasil direset ke: bismillah\n";
} else {
    echo "User tidak ditemukan\n";
}