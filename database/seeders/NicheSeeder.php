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
            'niche_data' => json_encode
            (['description' => 'Núcleo Certificador EJA',
             'nome_extenso' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Darcy Vargas'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'NEEJACP-PF',
            'habitat_id' => 1,
            'niche_data' => json_encode
            (['description' => 'Núcleo Certificador EJA',
             'nome_extenso' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Paulo Freire'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'UFCSPA:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos da UFCSPA',
             'nome_extenso' => 'Nicho para rateio de recursos amigos da UFCSPA - 5 números em 50'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'DIPP:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos do Marcelo Dipp',
             'nome_extenso' => 'Nicho para rateio de recursos amigos do Marcelo Dipp - 5 números em 50'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
