<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insere relações entre os termos
        DB::table('relations')->insert([
            [
                'id_term_bt' => 1,
                'id_term_nt' => 2,
                'id_niche' => 1,
                'id_user' => 1,
            ],
            [
                'id_term_bt' => 1,
                'id_term_nt' => 3,
                'id_niche' => 1,
                'id_user' => 1,
            ],
        ]);
    }
}
