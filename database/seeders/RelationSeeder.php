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
        "id_term_nt": 51,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 51,
        "id_term_nt": 2,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 51,
        "id_term_nt": 3,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 12
    },
    {
        "id_term_bt": 2,
        "id_term_nt": 4,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 111
    },
    {
        "id_term_bt": 2,
        "id_term_nt": 5,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 112
    },
    {
        "id_term_bt": 3,
        "id_term_nt": 52,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 123
    },
    {
        "id_term_bt": 3,
        "id_term_nt": 53,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 124
    },
    {
        "id_term_bt": 3,
        "id_term_nt": 54,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 121
    },
    {
        "id_term_bt": 3,
        "id_term_nt": 55,
        "id_niche": 5,
        "id_user": 1,
        "term_order": 122
    },
    {
        "id_term_bt": 50,
        "id_term_nt": 7,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 7,
        "id_term_nt": 8,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 8,
        "id_term_nt": 15,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 111
    },
    {
        "id_term_bt": 8,
        "id_term_nt": 9,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 112
    },
    {
        "id_term_bt": 8,
        "id_term_nt": 10,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 113
    },
    {
        "id_term_bt": 15,
        "id_term_nt": 42,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1111
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 11,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1121
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 14,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1122
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 13,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1123
    },
    {
        "id_term_bt": 9,
        "id_term_nt": 12,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1124
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 16,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1131
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 17,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1132
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 18,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1133
    },
    {
        "id_term_bt": 10,
        "id_term_nt": 19,
        "id_niche": 1,
        "id_user": 1,
        "term_order": 1134
    },
    {
        "id_term_bt": 47,
        "id_term_nt": 48,
        "id_niche": 2,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 48,
        "id_term_nt": 49,
        "id_niche": 2,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 43,
        "id_term_nt": 44,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 1
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 56,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 11
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 57,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 12
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 58,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 13
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 59,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 14
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 60,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 15
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 61,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 16
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 62,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 17
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 63,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 18
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 64,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 19
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 65,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 20
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 66,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 21
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 67,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 22
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 68,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 23
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 69,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 24
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 70,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 25
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 71,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 26
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 72,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 27
    },
    {
        "id_term_bt": 44,
        "id_term_nt": 73,
        "id_niche": 3,
        "id_user": 1,
        "term_order": 28
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
