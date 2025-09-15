<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersDataFlex;

class UsersDataFlexSeeder extends Seeder
{
    public function run(): void
    {
        UsersDataFlex::create([
            'user_id' => 1,
            'habitat_id' => 1,
            'niche_id' => 1,
            'user_data_flex' => json_encode(['info' => 'Primeiro vínculo flexível'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        UsersDataFlex::create([
            'user_id' => 2,
            'habitat_id' => 2,
            'niche_id' => 2,
            'user_data_flex' => json_encode(['info' => 'Segundo vínculo flexível'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
