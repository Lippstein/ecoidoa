<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsersDataFlex;

class UsersDataFlexSeeder extends Seeder
{
    public function run(): void
    {
        $profileData = [
            'certificationEFSI' => 'Certificação-EFSI não cadastrada', 
            'conclusionCertificationEFSI' => 'Conclusão de certificação não cadastrada', 
            'ak1EFSIName' => 'Nome AK1 não cadastrado',
            'ak1EFSIDescription' => 'Descrição AK1 não cadastrada',
            'ak1EFSIResult' => 'Resultado AK1 não cadastrado',
            'ak1EFSIConclusion' => 'Conclusão AK1 não cadastrada',
            'ak1EFSIObs' => 'Observação AK1 não cadastrada',
            'certificationEFSF' => 'Certificação-EFSF não cadastrada',
            'conclusionCertificationEFSF' => 'Conclusão de certificação não cadastrada',
            'ak1EFSFName' => 'Nome AK1 não cadastrado',
            'ak1EFSFDescription' => 'Descrição AK1 não cadastrada',
            'ak1EFSFResult' => 'Resultado AK1 não cadastrado',
            'ak1EFSFConclusion' => 'Conclusão AK1 não cadastrada',
            'ak1EFSFObs' => 'Observação AK1 não cadastrada',
            'ak2EFSFName' => 'Nome AK2 não cadastrado',
            'ak2EFSFDescription' => 'Descrição AK2 não cadastrada',
            'ak2EFSFResult' => 'Resultado AK2 não cadastrado',
            'ak2EFSFConclusion' => 'Conclusão AK2 não cadastrada',
            'ak2EFSFObs' => 'Observação AK2 não cadastrada',
            'ak3EFSFName' => 'Nome AK3 não cadastrado',
            'ak3EFSFDescription' => 'Descrição AK3 não cadastrada',
            'ak3EFSFResult' => 'Resultado AK3 não cadastrado',        
            'ak3EFSFConclusion' => 'Conclusão AK3 não cadastrada',
            'ak3EFSFObs' => 'Observação AK3 não cadastrada',
            'ak4EFSFName' => 'Nome AK4 não cadastrado',
            'ak4EFSFDescription' => 'Descrição AK4 não cadastrada',
            'ak4EFSFResult' => 'Resultado AK4 não cadastrado',
            'ak4EFSFConclusion' => 'Conclusão AK4 não cadastrada',
            'ak4EFSFObs' => 'Observação AK4 não cadastrada',
            'certificationEMAF' => 'Certificação-EMAF não cadastrada',    
            'conclusionCertificationEMAF' => 'Conclusão de certificação não cadastrada',
            'ak1EMAFName' => 'Nome AK1 não cadastrado',
            'ak1EMAFDescription' => 'Descrição AK1 não cadastrada',
            'ak1EMAFResult' => 'Resultado AK1 não cadastrado',
            'ak1EMAFConclusion' => 'Conclusão AK1 não cadastrada',
            'ak1EMAFObs' => 'Observação AK1 não cadastrada',
            'ak2EMAFName' => 'Nome AK2 não cadastrado',
            'ak2EMAFDescription' => 'Descrição AK2 não cadastrada',
            'ak2EMAFResult' => 'Resultado AK2 não cadastrado ',
            'ak2EMAFConclusion' => 'Conclusão AK2 não cadastrada',
            'ak2EMAFObs' => 'Observação AK2 não cadastrada',
            'ak3EMAFName' => 'Nome AK3 não cadastrado',
            'ak3EMAFDescription' => 'Descrição AK3 não cadastrada',
            'ak3EMAFResult' => 'Resultado AK3 não cadastrado',        
            'ak3EMAFConclusion' => 'Conclusão AK3 não cadastrada',
            'ak3EMAFObs' => 'Observação AK3 não cadastrada',
            'ak4EMAFName' => 'Nome AK4 não cadastrado',
            'ak4EMAFDescription' => 'Descrição AK4 não cadastrada',
            'ak4EMAFResult' => 'Resultado AK4 não cadastrado',
            'ak4EMAFConclusion' => 'Conclusão AK4 não cadastrada',
            'ak4EMAFObs' => 'Observação AK4 não cadastrada',
        ];

        UsersDataFlex::create([
            'user_id' => 1,
            'habitat_id' => 1,
            'niche_id' => 1,
            'user_profile' => $profileData,
            'created_at' => now(),
        ]);
        UsersDataFlex::create([
            'user_id' => 1,
            'habitat_id' => 1,
            'niche_id' => 2,
            'user_profile' => $profileData,
            'created_at' => now(),
        ]);
        UsersDataFlex::create([
            'user_id' => 2,
            'habitat_id' => 2,
            'niche_id' => 2,
            'user_profile' => $profileData,
            'created_at' => now(),
        ]);
    }
}
