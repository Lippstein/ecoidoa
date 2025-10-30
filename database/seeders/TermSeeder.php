<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('terms')->insert([
            [
                'term' => 'Ecossistema IDOA',
                'definition' => 'Conjunto de sistemas e processos que interagem no ambiente IdoA.',
                'language' => 'pt_BR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Habitat IDOA',
                'definition' => 'Sistema que agrupa niches com características semelhantes.',
                'language' => 'pt_BR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'term' => 'Niche IDOA',
                'definition' => 'Função ou papel específico dentro de um habitat.',
                'language' => 'pt_BR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
