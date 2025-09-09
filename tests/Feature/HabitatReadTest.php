<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Habitat;

class HabitatReadTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_reads_habitat_data_and_shows_accents()
    {
        // Seed the database
        $this->seed();

        $habitat = Habitat::where('habitat', 'NEAD')->first();
        $data = $habitat->habitat_data;

        // Verifica se o campo JSON está decodificado corretamente
        $this->assertIsArray($data);
        $this->assertEquals('Núcleo de Educação Aberta e a Distância', $data['descricao']);
        // Exibe o valor para inspeção manual
        fwrite(STDOUT, "\nDescricao: " . $data['descricao'] . "\n");
    }
}
