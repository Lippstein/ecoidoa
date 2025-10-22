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
            'habitat_data' => json_encode(["description" => "Núcleo de Educação Aberta e a Distância", 
                                            "habitaturl" => "https://nead.idoa.com.br",
                                         "habitat_owner" => "Alípio Airton Lippstein",
                                           "email_owner" => "aalippstein@gmail.com"], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Habitat::create([
            'habitat' => 'RATEIO',
            'habitat_data' => json_encode(["description" => "Setor de Rateio de Recursos", 
                                            "habitaturl" => "https://rateio.idoa.com.br",
                                         "habitat_owner" => "Alípio Airton Lippstein",
                                           "email_owner" => "aalippstein@gmail.com"], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
        Habitat::create([
            'habitat' => 'TESAURO',
            'habitat_data' => json_encode(["description" => "Setor de Tesauro", 
                                            "habitaturl" => "https://tesauro.idoa.com.br",
                                         "habitat_owner" => "Alípio Airton Lippstein",
                                           "email_owner" => "aalippstein@gmail.com"], JSON_UNESCAPED_UNICODE),
            'created_at' => now(),
        ]);
    }
}
