<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersDataFlexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rows = json_decode(<<<'JSON'
[
    {
        "user_id": 1,
        "habitat_id": 1,
        "niche_id": 1,
        "user_profile": "{\"certificationEFSI\":\"Ensino Fundamental S\\u00e9ries Iniciais de Educa\\u00e7\\u00e3o de Jovens e Adultos\",\"conclusionCertificationEFSI\":\"2024\",\"ak1EFSIName\":\"LINGUAGENS E MATEM\\u00c1TICA\",\"ak1EFSIDescription\":\"L\\u00edngua Portuguesa e Matem\\u00e1tica\",\"ak1EFSIResult\":\"A\",\"ak1EFSIConclusion\":\"2024\",\"ak1EFSIObs\":\"A=Aprovado\",\"certificationEFSF\":\"Ensino Fundamental S\\u00e9ries Finais de Educa\\u00e7\\u00e3o de Jovens e Adultos\",\"conclusionCertificationEFSF\":\"2025\",\"ak1EFSFName\":\"LINGUAGENS\",\"ak1EFSFDescription\":\"L\\u00edngua Portuguesa, L\\u00edngua Inglesa, Arte e Educa\\u00e7\\u00e3o F\\u00edsica\",\"ak1EFSFResult\":\"A\",\"ak1EFSFConclusion\":\"17\\\/07\\\/2025\",\"ak1EFSFObs\":\"A=Aprovado\",\"ak2EFSFName\":\"MATEM\\u00c1TICA\",\"ak2EFSFDescription\":\"Matem\\u00e1tica\",\"ak2EFSFResult\":\"A\",\"ak2EFSFConclusion\":\"15\\\/07\\\/2025\",\"ak2EFSFObs\":\"A=Aprovado\",\"ak3EFSFName\":\"CI\\u00caNCIAS DA NATUREZA\",\"ak3EFSFDescription\":\"Ci\\u00eancias\",\"ak3EFSFResult\":\"A\",\"ak3EFSFConclusion\":\"30\\\/06\\\/2025\",\"ak3EFSFObs\":\"A=Aprovado\",\"ak4EFSFName\":\"CI\\u00caNCIAS HUMANAS\",\"ak4EFSFDescription\":\"Geografia e Hist\\u00f3ria\",\"ak4EFSFResult\":\"A\",\"ak4EFSFConclusion\":\"08\\\/07\\\/2025\",\"ak4EFSFObs\":\"A=Aprovado\",\"certificationEMAF\":\"Ensino M\\u00e9dio de Educa\\u00e7\\u00e3o de Jovens e Adultos\",\"conclusionCertificationEMAF\":\"Cursando\",\"ak1EMAFName\":\"LINGUAGENS E SUAS TECNOLOGIAS\",\"ak1EMAFDescription\":\"L\\u00edngua Portuguesa, Literatura, L\\u00edngua Espanhola, L\\u00edngua Inglesa, Arte e Educa\\u00e7\\u00e3o F\\u00edsica\",\"ak1EMAFResult\":\"A\",\"ak1EMAFConclusion\":\"04\\\/09\\\/2025\",\"ak1EMAFObs\":\"A=Aprovado - Aproveitamento de estudos do Exame Nacional do Ensino M\\u00e9dio, ENEM\\\/2015, SEDUC, Porto Alegre\\\/RS.\",\"ak2EMAFName\":\"MATEM\\u00c1TICA E SUAS TECNOLOGIAS\",\"ak2EMAFDescription\":\"Matem\\u00e1tica\",\"ak2EMAFResult\":\"6,00\",\"ak2EMAFConclusion\":\"10\\\/09\\\/2025\",\"ak2EMAFObs\":null,\"ak3EMAFName\":\"CI\\u00caNCIAS DA NATUREZA E SUAS TECNOLOGIAS\",\"ak3EMAFDescription\":\"F\\u00edsica, Qu\\u00edmica e Biologia\",\"ak3EMAFResult\":\"5,67\",\"ak3EMAFConclusion\":\"25\\\/08\\\/2025\",\"ak3EMAFObs\":null,\"ak4EMAFName\":\"CI\\u00caNCIAS HUMANAS E SOCIAIS APLICADAS\",\"ak4EMAFDescription\":\"Geografia, Hist\\u00f3ria, Sociologia e Filosofia\",\"ak4EMAFResult\":null,\"ak4EMAFConclusion\":null,\"ak4EMAFObs\":null,\"totalPrize\":8.57,\"availableBalance\":0.93,\"totalCredits\":0.93}",
        "created_at": "2026-02-12 13:11:01",
        "updated_at": "2026-06-01 16:48:37"
    },
    {
        "user_id": 1,
        "habitat_id": 1,
        "niche_id": 2,
        "user_profile": "{\"certificationEFSI\":\"Certifica\\u00e7\\u00e3o-EFSI n\\u00e3o cadastrada\",\"conclusionCertificationEFSI\":\"Conclus\\u00e3o de certifica\\u00e7\\u00e3o n\\u00e3o cadastrada\",\"ak1EFSIName\":\"Nome AK1 n\\u00e3o cadastrado\",\"ak1EFSIDescription\":\"Descri\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EFSIResult\":\"Resultado AK1 n\\u00e3o cadastrado\",\"ak1EFSIConclusion\":\"Conclus\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EFSIObs\":\"Observa\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"certificationEFSF\":\"Certifica\\u00e7\\u00e3o-EFSF n\\u00e3o cadastrada\",\"conclusionCertificationEFSF\":\"Conclus\\u00e3o de certifica\\u00e7\\u00e3o n\\u00e3o cadastrada\",\"ak1EFSFName\":\"Nome AK1 n\\u00e3o cadastrado\",\"ak1EFSFDescription\":\"Descri\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EFSFResult\":\"Resultado AK1 n\\u00e3o cadastrado\",\"ak1EFSFConclusion\":\"Conclus\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EFSFObs\":\"Observa\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak2EFSFName\":\"Nome AK2 n\\u00e3o cadastrado\",\"ak2EFSFDescription\":\"Descri\\u00e7\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak2EFSFResult\":\"Resultado AK2 n\\u00e3o cadastrado\",\"ak2EFSFConclusion\":\"Conclus\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak2EFSFObs\":\"Observa\\u00e7\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak3EFSFName\":\"Nome AK3 n\\u00e3o cadastrado\",\"ak3EFSFDescription\":\"Descri\\u00e7\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak3EFSFResult\":\"Resultado AK3 n\\u00e3o cadastrado\",\"ak3EFSFConclusion\":\"Conclus\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak3EFSFObs\":\"Observa\\u00e7\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak4EFSFName\":\"Nome AK4 n\\u00e3o cadastrado\",\"ak4EFSFDescription\":\"Descri\\u00e7\\u00e3o AK4 n\\u00e3o cadastrada\",\"ak4EFSFResult\":\"Resultado AK4 n\\u00e3o cadastrado\",\"ak4EFSFConclusion\":\"Conclus\\u00e3o AK4 n\\u00e3o cadastrada\",\"ak4EFSFObs\":\"Observa\\u00e7\\u00e3o AK4 n\\u00e3o cadastrada\",\"certificationEMAF\":\"Certifica\\u00e7\\u00e3o-EMAF n\\u00e3o cadastrada\",\"conclusionCertificationEMAF\":\"Conclus\\u00e3o de certifica\\u00e7\\u00e3o n\\u00e3o cadastrada\",\"ak1EMAFName\":\"Nome AK1 n\\u00e3o cadastrado\",\"ak1EMAFDescription\":\"Descri\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EMAFResult\":\"Resultado AK1 n\\u00e3o cadastrado\",\"ak1EMAFConclusion\":\"Conclus\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak1EMAFObs\":\"Observa\\u00e7\\u00e3o AK1 n\\u00e3o cadastrada\",\"ak2EMAFName\":\"Nome AK2 n\\u00e3o cadastrado\",\"ak2EMAFDescription\":\"Descri\\u00e7\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak2EMAFResult\":\"Resultado AK2 n\\u00e3o cadastrado \",\"ak2EMAFConclusion\":\"Conclus\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak2EMAFObs\":\"Observa\\u00e7\\u00e3o AK2 n\\u00e3o cadastrada\",\"ak3EMAFName\":\"Nome AK3 n\\u00e3o cadastrado\",\"ak3EMAFDescription\":\"Descri\\u00e7\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak3EMAFResult\":\"Resultado AK3 n\\u00e3o cadastrado\",\"ak3EMAFConclusion\":\"Conclus\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak3EMAFObs\":\"Observa\\u00e7\\u00e3o AK3 n\\u00e3o cadastrada\",\"ak4EMAFName\":\"Nome AK4 n\\u00e3o cadastrado\",\"ak4EMAFDescription\":\"Descri\\u00e7\\u00e3o AK4 n\\u00e3o cadastrada\",\"ak4EMAFResult\":\"Resultado AK4 n\\u00e3o cadastrado\",\"ak4EMAFConclusion\":\"Conclus\\u00e3o AK4 n\\u00e3o cadastrada\",\"ak4EMAFObs\":\"Observa\\u00e7\\u00e3o AK4 n\\u00e3o cadastrada\"}",
        "created_at": "2026-02-12 13:11:02",
        "updated_at": "2026-02-12 10:11:02"
    },
    {
        "user_id": 2,
        "habitat_id": 2,
        "niche_id": 3,
        "user_profile": "{\"maintenance\":\"5.00\",\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"availableBalance\":76.51,\"totalCredits\":0.51,\"totalDebts\":24}",
        "created_at": "2026-02-12 13:11:02",
        "updated_at": "2026-06-01 16:27:42"
    },
    {
        "user_id": 2,
        "habitat_id": 2,
        "niche_id": 4,
        "user_profile": null,
        "created_at": "2026-04-11 19:54:29",
        "updated_at": "2026-04-11 19:54:29"
    },
    {
        "user_id": 4,
        "habitat_id": 2,
        "niche_id": 3,
        "user_profile": "{\"maintenance\":\"5.00\",\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"availableBalance\":76.51,\"totalCredits\":0.51,\"totalDebts\":24}",
        "created_at": "2026-04-12 22:05:02",
        "updated_at": "2026-06-01 16:27:42"
    }
]
JSON
, true);

        $rows = array_map(static function (array $row): array {
            if (array_key_exists('user_profile', $row)) {
                $profile = $row['user_profile'];

                if (is_string($profile)) {
                    $profile = trim($profile);

                    if ($profile === '') {
                        $row['user_profile'] = null;
                        return $row;
                    }

                    $decodedProfile = json_decode($profile, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $profile = $decodedProfile;
                    }
                }

                if (is_array($profile) || is_object($profile)) {
                    $encodedProfile = json_encode($profile, JSON_UNESCAPED_UNICODE);
                    $row['user_profile'] = $encodedProfile === false ? null : $encodedProfile;
                } elseif ($profile === null) {
                    $row['user_profile'] = null;
                }
            }

            return $row;
        }, $rows);

        DB::table('users_data_flex')->insert($rows);
    }
}
