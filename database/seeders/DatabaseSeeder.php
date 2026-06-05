<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ambil pengaturan dari .env atau gunakan default
        $lurahEmail = env('DEFAULT_LURAH_EMAIL', 'lurah@gmail.com');
        $lurahName = env('DEFAULT_LURAH_NAME', 'Lurah');
        $lurahPass = env('DEFAULT_LURAH_PASSWORD', 'password123');

        // Buat Akun Lurah (Hanya jika belum ada email tersebut di database)
        if (!User::where('email', $lurahEmail)->exists()) {
            User::create([
                'name' => $lurahName,
                'email' => $lurahEmail,
                'password' => \Illuminate\Support\Facades\Hash::make($lurahPass),
                'role' => 'Lurah',
                'nik' => '0000000000000000',
                'nokk' => '0000000000000000',
                'jeniskelamin' => 'Laki-laki',
                'alamat' => 'Kantor Lurah',
            ]);
        }
    }
}
