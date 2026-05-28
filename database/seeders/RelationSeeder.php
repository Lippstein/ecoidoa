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
        $relations = json_decode(<<<'JSON'
[
    {
        "id_term_bt": 6,
        "id_term_nt": 2,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 6,
        "id_term_nt": 3,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 2
    },
    {
        "id_term_bt": 2,
        "id_term_nt": 4,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 2,
        "id_term_nt": 5,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 2
    },
    {
        "id_term_bt": 1,
        "id_term_nt": 6,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 60,
        "id_term_nt": 7,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 7,
        "id_term_nt": 9,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 10,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 11,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 113
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 12,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1121
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 13,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1125
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 15,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1122
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 16,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 111
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 14,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1124
    },
    {
        "id_term_bt": 11,
        "id_term_nt": 19,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1131
    },
    {
        "id_term_bt": 11,
        "id_term_nt": 20,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1132
    },
    {
        "id_term_bt": 11,
        "id_term_nt": 21,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1133
    },
    {
        "id_term_bt": 11,
        "id_term_nt": 22,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1134
    },
    {
        "id_term_bt": 14,
        "id_term_nt": 23,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 11241
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 24,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112411
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 25,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112412
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 26,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112413
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 27,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112414
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 28,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112415
    },
    {
        "id_term_bt": 23,
        "id_term_nt": 29,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112416
    },
    {
        "id_term_bt": 14,
        "id_term_nt": 30,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 11242
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 31,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112421
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 32,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112422
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 33,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112423
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 34,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112424
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 35,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112425
    },
    {
        "id_term_bt": 30,
        "id_term_nt": 36,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112426
    },
    {
        "id_term_bt": 14,
        "id_term_nt": 37,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 11243
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 38,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112431
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 39,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112432
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 40,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112433
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 41,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112434
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 42,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112435
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 43,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112436
    },
    {
        "id_term_bt": 37,
        "id_term_nt": 44,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112437
    },
    {
        "id_term_bt": 16,
        "id_term_nt": 45,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1111
    },
    {
        "id_term_bt": 53,
        "id_term_nt": 54,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 55,
        "id_term_nt": 56,
        "id_niche": 4,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 57,
        "id_term_nt": 58,
        "id_niche": 2,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 58,
        "id_term_nt": 59,
        "id_niche": 2,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 24,
        "id_term_nt": 87,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1124111
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 155,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 156,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 12
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 157,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 13
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 158,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 14
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 159,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 15
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 160,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 16
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 161,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 17
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 162,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 18
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 163,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 19
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 164,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 20
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 165,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 21
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 166,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 22
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 167,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 23
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 168,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 24
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 169,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 25
    },
    {
        "id_term_bt": 54,
        "id_term_nt": 170,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 26
    }
]
JSON
, true);

        $termIds = DB::table('terms')->pluck('id')->flip();
        $nicheIds = DB::table('niches')->pluck('id')->flip();
        $userIds = DB::table('users')->pluck('id')->flip();

        $validRelations = array_values(array_filter($relations, static function (array $relation) use ($termIds, $nicheIds, $userIds): bool {
            return isset($termIds[$relation['id_term_bt']])
                && isset($termIds[$relation['id_term_nt']])
                && isset($nicheIds[$relation['id_niche']])
                && isset($userIds[$relation['id_user']]);
        }));

        if (!empty($validRelations)) {
            DB::table('relations')->insert($validRelations);
        }
    }
}
