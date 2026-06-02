<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'aalippstein@gmail.com',
                'name' => 'A A Lippstein',
                'password' => '$2y$12$klZw3nYnh6r1TNBgGNt3K.83JrqZ2vMIZYsPKaMTHSo9qj6pMkmWe',
                'remember_token' => null,
                'level' => 9,
                'address_data' => '{"street":"Rua n\u00e3o cadastrada","number":"N\u00famero n\u00e3o cadastrado","city":"Cidade n\u00e3o cadastrada","state":"Estado n\u00e3o cadastrado","zip":"CEP n\u00e3o cadastrado","country":"Brasil","cellphone":"Celular n\u00e3o cadastrado","phone":"Telefone n\u00e3o cadastrado","whatsapp":"WhatsApp n\u00e3o cadastrado","telegram":"Telegram n\u00e3o cadastrado","facebook":"Facebook n\u00e3o cadastrado","instagram":"Instagram n\u00e3o cadastrado"}',
                'document_data' => '"{\\"type\\":\\"Tipo de documento n\\u00e3o cadastrado\\",\\"doc_number\\":\\"N\\u00famero de documento n\\u00e3o cadastrado\\",\\"issuer\\":\\"\\u00d3rg\\u00e3o emissor n\\u00e3o cadastrado\\",\\"birth\\":\\"1962-03-18\\",\\"birthplace\\":\\"Local de nascimento n\\u00e3o cadastrado\\",\\"nationality\\":\\"Nacionalidade n\\u00e3o cadastrada\\",\\"issue_date\\":\\"2026-06-18\\",\\"valid_to\\":\\"2026-06-30\\",\\"cnh\\":\\"CNH n\\u00e3o cadastrada\\",\\"rg\\":\\"RG n\\u00e3o cadastrado\\",\\"cpf\\":\\"3602990025\\",\\"workcard\\":\\"Carteira de trabalho n\\u00e3o cadastrada\\",\\"election\\":\\"T\\u00edtulo de eleitor n\\u00e3o cadastrado\\",\\"passport\\":\\"Passaporte n\\u00e3o cadastrado\\",\\"mother\\":\\"Nome da m\\u00e3e n\\u00e3o cadastrado\\",\\"father\\":\\"Nome do pai n\\u00e3o cadastrado\\",\\"marital\\":\\"Casado\\",\\"profession\\":\\"Professor\\",\\"gender\\":\\"Masculino\\"}"',
                'created_at' => '2026-06-01 16:16:39',
                'updated_at' => '2026-06-01 17:19:21',
            ],
            [
                'id' => 2,
                'email' => 'lippstein@hotmail.com',
                'name' => 'A A Lippstein Hotmail',
                'password' => '$2y$12$q3S/iuHMLD1xJ/CyBjm.yOEDGNAAD.yaoNVt.RoMIWL/0acU80qZy',
                'remember_token' => null,
                'level' => 1,
                'address_data' => '"[]"',
                'document_data' => '"[]"',
                'created_at' => '2026-06-01 16:16:40',
                'updated_at' => '2026-06-01 13:16:40',
            ],
            [
                'id' => 3,
                'email' => 'rodrigues.lan199@gmail.com',
                'name' => 'Allan',
                'password' => '$2y$12$OjEhfHW.1J9mZtywecRCF.pTc7w2lIsEfYq9DwysAGrpB6u/LWDBa',
                'remember_token' => null,
                'level' => 3,
                'address_data' => '"[]"',
                'document_data' => '"[]"',
                'created_at' => '2026-06-01 16:16:40',
                'updated_at' => '2026-06-01 13:16:40',
            ],
            [
                'id' => 4,
                'email' => 'alipio-alippstein@educar.rs.gov.br',
                'name' => 'Alípio A Lippstein Educar',
                'password' => '$2y$12$7TjFNASdEkOKNmD76ywbd.ujNS9dsMNdyyKcXb.GExLVNf6Cud7KC',
                'remember_token' => null,
                'level' => 0,
                'address_data' => '"[]"',
                'document_data' => '"[]"',
                'created_at' => '2026-06-01 16:16:40',
                'updated_at' => '2026-06-01 13:16:40',
            ],
        ]);
    }
}
