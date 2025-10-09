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
            'name' => 'A A Lippstein',
            'email' => 'lippstein@hotmail.com',
            'password' => Hash::make('12345678'),
            'address_data' => json_encode([]),
            'document_data' => json_encode([]),
            'level' => 0,
            'created_at' => now(),
        ]);
    }
}
