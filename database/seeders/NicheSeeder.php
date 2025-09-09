<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Niche;

class NicheSeeder extends Seeder
{
    public function run(): void
    {
        Niche::create([
            'niche' => 'NEEJACP-DV',
            'habitat_id' => 1,
            'niche_data' => json_encode(['description' => 'Núcleo Certificador EJA'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'NEEJACP-PF',
            'habitat_id' => 1,
            'niche_data' => json_encode(['description' => 'Núcleo Certificador EJA'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'UFCSPA:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode(['description' => 'Nicho para rateio de recursos amigos da UFCSPA'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'DIPP:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode(['description' => 'Nicho para rateio de recursos amigos do Marcelo Dipp'], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
