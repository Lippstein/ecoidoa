<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habitat;
use Illuminate\Database\Eloquent\JsonEncodingException;

class HabitatSeeder extends Seeder
{
    public function run(): void
    {
        Habitat::create([
            'habitat' => 'NEAD',
            'habitat_data' => json_encode(["description" => "Núcleo de Educação Aberta e a Distância", "habitaturl" => "nead"], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Habitat::create([
            'habitat' => 'RATEIO',
            'habitat_data' => json_encode(["description" => "Setor de Rateio de Recursos", "habitaturl" => "https://rateio.idoa.com.br"], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
