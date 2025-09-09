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
            'user_data' => json_encode([], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        User::create([
            'name' => 'A A Lippstein',
            'email' => 'lippstein@hotmail.com',
            'password' => Hash::make('12345678'),
            'user_data' => json_encode([], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
