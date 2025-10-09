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
            'company_name' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Darcy Vargas',
            'trade_name' => 'NEEJACP-DV'],
            JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'NEEJACP-PF',
            'habitat_id' => 1,
            'niche_data' => json_encode
          (['description' => 'Núcleo Certificador EJA',
            'company_name' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Paulo Freire',
            'trade_name' => 'NEEJACP-PF'],
            JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'UFCSPA:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos da UFCSPA',
            'company_name' => 'Nicho para rateio de recursos amigos da UFCSPA - 5 números em 50',
            'trade_name' => 'UFCSPA:5-50'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Niche::create([
            'niche' => 'DIPP:5-50',
            'habitat_id' => 2,
            'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos do Marcelo Dipp',
            'company_name' => 'Nicho para rateio de recursos amigos do Marcelo Dipp - 5 números em 50',
            'trade_name' => 'DIPP:5-50'],
              JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
