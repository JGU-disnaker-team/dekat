<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama' => 'Kirana',
            'email' => 'intania@student.jgu.ac.id',
            'no_telp' => '',
            'password' => Hash::make('adminkirana1'),
            'alamat' => '',
            'kode_pos' => '',
            'kelurahan' => '',
            'kecamatan' => '',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ])->assignRole('admin');
    }
}