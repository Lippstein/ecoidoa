<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'A A Lippstein',
            'email' => 'aalippstein@gmail.com',
            'password' => Hash::make('12345678'),
            'address_data' => json_encode([]),
            'document_data' => json_encode([]),
            'level' => 9,
            'created_at' => now(),
        ]);
        User::create([
            'name' => 'A A Lippstein Hotmail',
            'email' => 'lippstein@hotmail.com',
            'password' => Hash::make('12345678'),
            'address_data' => json_encode([]),
            'document_data' => json_encode([]),
            'level' => 1,
            'created_at' => now(),
        ]);
        User::create([
            'name' => 'Allan',
            'email' => 'rodrigues.lan199@gmail.com',
            'password' => Hash::make('12345678'),
            'address_data' => json_encode([]),
            'document_data' => json_encode([]),
            'level' => 3,
            'created_at' => now(),
        ]);
        User::create([
            'name' => 'Alípio A Lippstein Educar',
            'email' => 'alipio-alippstein@educar.rs.gov.br',
            'password' => Hash::make('12345678'),
            'address_data' => json_encode([]),
            'document_data' => json_encode([]),
            'level' => 0,
            'created_at' => now(),
        ]);
    }
}
