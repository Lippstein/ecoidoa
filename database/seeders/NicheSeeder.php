<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Niche;

class NicheSeeder extends Seeder
{
    public function run(): void
    {
        Niche::create([
        'niche' => 'NEEJACP-DV',
        'habitat_id' => 1,
        'niche_data' => json_encode
            (['description' => 'Núcleo Certificador EJA',
             'company_name' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Darcy Vargas',
               'trade_name' => 'NEEJACP-DV',
               'foundation' => 'Decreto 41.744 - D.O. de 26/07/2002',
            'authorization' => 'Parecer 1465/2002 - D.O. de 30/12/2002', //autorização1 autorizaçao2
            'address' => [
                        'street' => 'Av. João Pessoa',
                        'number' => '1070',
                          'city' => 'Porto Alegre', // ver localidaede
                         'state' => 'RS',
                           'zip' => '90040-000',
                       'country' => 'Brasil',
                     'cellphone' => '(51) 9 9619-3338',
                         'phone' => '(51) 0000-0000',
                          'site' => 'wwww.neejacp-dv.com.br',
                         'email' => 'email@neejacp-dv.com.br',
                      'whatsapp' => '(51) 9 9619-3338',
                      'telegram' => 'Telegram não cadastrado',
                      'facebook' => 'Facebook não cadastrado',
                     'instagram' => 'Instagram não cadastrado',
                    ],
                    'rules' => [
                         'rule0' => 'Regra 1 não cadastrada',
                         'rule1' => 'Regra 2 não cadastrada',
                         'rule2' => 'Regra 3 não cadastrada',
                         'rule3' => 'Regra 4 não cadastrada',
                         'rule4' => 'Regra 5 não cadastrada',
                         'rule5' => 'Regra 6 não cadastrada',
                         'rule6' => 'Regra 7 não cadastrada',
                         'rule7' => 'Regra 8 não cadastrada',
                         'rule8' => 'Regra 9 não cadastrada',
                         'rule9' => 'Regra 10 não cadastrada'
                    ],
          ],
            JSON_UNESCAPED_UNICODE),

          // 'niche_params' => json_encode
          // ([
          //     'level' => 'Séries Iniciais',
          //     'activities' => ['activity1','activity2'],
          //     'param1' => 'Ensino Fundamental',
          //     'param2' => 'Ensino Médio',
          //     'param3' => 'Valor do parâmetro',
          // ], JSON_UNESCAPED_UNICODE),

        'created_at' => now(), 
        ]);
        Niche::create([
        'niche' => 'NEEJACP-PF',
        'habitat_id' => 1,
        'niche_data' => json_encode
            (['description' => 'Núcleo Certificador EJA',
             'company_name' => 'Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Paulo Freire',
               'trade_name' => 'NEEJACP-PF',
               'foundation' => 'Decreto 41.744 - D.O. de 26/07/2002',
            'authorization' => 'Parecer 1465/2002 - D.O. de 30/12/2002',
                  'address' => [
                        'street' => 'Rua não cadastrada',
                        'number' => 'Número não cadastrado',
                          'city' => 'Cidade não cadastrada',
                         'state' => 'Estado não cadastrado',
                           'zip' => 'CEP não cadastrado',
                       'country' => 'Brasil',
                     'cellphone' => 'Celular não cadastrado',
                         'phone' => 'Telefone não cadastrado',
                          'site' => 'Site não cadastrado',
                         'email' => 'Email não cadastrado',
                      'whatsapp' => 'WhatsApp não cadastrado',
                      'telegram' => 'Telegram não cadastrado',
                      'facebook' => 'Facebook não cadastrado',
                     'instagram' => 'Instagram não cadastrado',
                    ],
                    'rules' => [
                         'rule0' => 'Regra 1 não cadastrada',
                         'rule1' => 'Regra 2 não cadastrada',
                         'rule2' => 'Regra 3 não cadastrada',
                         'rule3' => 'Regra 4 não cadastrada',
                         'rule4' => 'Regra 5 não cadastrada',
                         'rule5' => 'Regra 6 não cadastrada',
                         'rule6' => 'Regra 7 não cadastrada',
                         'rule7' => 'Regra 8 não cadastrada',
                         'rule8' => 'Regra 9 não cadastrada',
                         'rule9' => 'Regra 10 não cadastrada'
                    ],
          ],
            JSON_UNESCAPED_UNICODE),
        'created_at' => now(),
        ]);
        Niche::create([
        'niche' => 'UFCSPA-5',
        'habitat_id' => 2,
        'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos da UFCSPA',
             'company_name' => 'Nicho para rateio de recursos amigos da UFCSPA - 5 números em 50',
               'trade_name' => 'UFCSPA:QUINA',
               'foundation' => 'Não Cadastrado',
            'authorization' => 'Não Cadastrado',
                  'address' => [
                        'street' => 'Rua não cadastrada',
                        'number' => 'Número não cadastrado',
                          'city' => 'Cidade não cadastrada',
                         'state' => 'Estado não cadastrado',
                           'zip' => 'CEP não cadastrado',
                       'country' => 'Brasil',
                     'cellphone' => 'Celular não cadastrado',
                         'phone' => 'Telefone não cadastrado',
                          'site' => 'Site não cadastrado',
                         'email' => 'Email não cadastrado',
                      'whatsapp' => 'WhatsApp não cadastrado',
                      'telegram' => 'Telegram não cadastrado',
                      'facebook' => 'Facebook não cadastrado',
                     'instagram' => 'Instagram não cadastrado',
                    ],
                    'rules' => [
                         'rule0' => 'No seu cadastro neste grupo você recebe R$ 100,00 de crédito.
O preço da rodada do Rateio é de R$ 1,00. 
O valor será debitado automaticamente do seu saldo.
Deixe marcado a opção repetir para participar de todos os Rateios (6 por semana).
Se o valor do saldo for menor que R$ 1,00 você precisará quitar seus débitos para continuar no Rateio.',
                         'rule1' => 'Uma taxa de R$ 5,00 (cinco reais) será debitada, uma única vez na sua conta, para manutenção do sistema.',
                         'rule2' => 'Marque 5 números dentre os 80 disponíveis.
Cada membro pode ter somente uma série de 5 números.',
                         'rule3' => 'São 6 Rateios semanais: de segunda-feira a sábado, a partir das 20h',
                         'rule4' => 'Para o sorteio dos 5 números do Rateio do grupo UFCSPA:Quina, é utilizado 1 globo, carregado com bolas numeradas de 01 a 80.',
                         'rule5' => 'Premiação:
O premio bruto corresponde a 100,00% da arrecadação. 
Deste valor:
• 50% são distribuídos entre os acertadores dos 5 números,
• 15% entre os acertadores de 4 números,
• 10% entre os acertadores de 3 números,
• 05% entre os acertadores de 2 números,
• 10% acumulam para os Rateios de final 5,
• 10% acumulam para o Rateio Especial de Junho de cada ano.',
                         'rule6' => 'Não havendo acertador em qualquer faixa de premiação, os valores acumulam para o concurso seguinte, nas respectivas faixas.',
                         'rule7' => 'O valor destinado aos prêmios do Rateio Especial de Junho de cada ano tem a seguinte distribuição:
a) 65% rateados entre os acertadores dos 5 prognósticos–quina;
b) 15% rateados entre os acertadores dos 4 prognósticos certos–quadra;
c) 10% rateados entre os acertadores dos 3 prognósticos certos–terno;
d) 10% rateados entre os acertadores dos 2 prognósticos certos–duque;',
                         'rule8' => 'Critério de acumulação do Rateio Especial de Junho:
Não existindo rateios premiados na quina, o valor é somado a quadra e rateado.
Não existindo rateios premiados na quina e na quadra, o valor é somado ao terno e rateado.
Não existindo rateios premiados na quina, na quadra e no terno, os valor é somado ao duque e rateado.
Não existindo rateios premiados na quina, quadra, terno e duque, o valor é rateado entre todos os participantes.',
                         'rule9' => 'Os membros do grupo ficarão como fiel-depositário dos valores rateados (créditos e débitos). Quando seu saldo zerar, para continuar no grupo, deverá quitar seus débitos.'
                    ],
          ],
            JSON_UNESCAPED_UNICODE),
        'created_at' => now(),
        ]);
        Niche::create([
        'niche' => 'DIPP-5',
        'habitat_id' => 2,
        'niche_data' => json_encode
            (['description' => 'Nicho para rateio de recursos amigos do Marcelo Dipp',
             'company_name' => 'Nicho para rateio de recursos amigos do Marcelo Dipp - 5 números em 50',
               'trade_name' => 'DIPP:QUINA',
               'foundation' => 'Não Cadastrado',
            'authorization' => 'Não Cadastrado',
                  'address' => [
                        'street' => 'Rua não cadastrada',
                        'number' => 'Número não cadastrado',
                          'city' => 'Cidade não cadastrada',
                         'state' => 'Estado não cadastrado',
                           'zip' => 'CEP não cadastrado',
                       'country' => 'Brasil',
                     'cellphone' => 'Celular não cadastrado',
                         'phone' => 'Telefone não cadastrado',
                          'site' => 'Site não cadastrado',
                         'email' => 'Email não cadastrado',
                      'whatsapp' => 'WhatsApp não cadastrado',
                      'telegram' => 'Telegram não cadastrado',
                      'facebook' => 'Facebook não cadastrado',
                     'instagram' => 'Instagram não cadastrado',
                    ],
                    'rules' => [
                         'rule0' => 'Regra 1 não cadastrada',
                         'rule1' => 'Regra 2 não cadastrada',
                         'rule2' => 'Regra 3 não cadastrada',
                         'rule3' => 'Regra 4 não cadastrada',
                         'rule4' => 'Regra 5 não cadastrada',
                         'rule5' => 'Regra 6 não cadastrada',
                         'rule6' => 'Regra 7 não cadastrada',
                         'rule7' => 'Regra 8 não cadastrada',
                         'rule8' => 'Regra 9 não cadastrada',
                         'rule9' => 'Regra 10 não cadastrada'
                    ],
          ],
            JSON_UNESCAPED_UNICODE),
        'created_at' => now(),
        ]);
        Niche::create([
        'niche' => 'IDOA-TES',
        'habitat_id' => 3,
        'niche_data' => json_encode
            (['niche' => 'IDOA-TES',
             'description' => 'Tesauro do IdoA',
             'company_name' => 'Instituto de Filosofia do Antropoceno',
               'trade_name' => 'IdoA',
               'foundation' => 'Fundação não cadastrada',
            'authorization1' => 'Autorização 1 não cadastrada',
            'authorization2' => 'Autorização 2 não cadastrada',
                     'cnpj' => 'CNPJ não cadastrado',
                  'address' => [
                        'street' => 'Rua não cadastrada',
                        'number' => 'Número não cadastrado',
                           'zip' => 'CEP não cadastrado',
                  'neighborhood' => 'Centro',
                      'locality' => 'Porto Alegre',
                          'city' => 'Porto Alegre',
                         'state' => 'Estado não cadastrado',
                       'country' => 'Brasil',
                     'cellphone' => 'Celular não cadastrado',
                         'phone' => 'Telefone não cadastrado',
                          'site' => 'Site não cadastrado',
                         'email' => 'Email não cadastrado',
                      'whatsapp' => 'WhatsApp não cadastrado',
                      'telegram' => 'Telegram não cadastrado',
                      'facebook' => 'Facebook não cadastrado',
                     'instagram' => 'Instagram não cadastrado',
                    ],
                    'rules' => [
                         'rule0' => 'Regra 1 não cadastrada',
                         'rule1' => 'Regra 2 não cadastrada',
                         'rule2' => 'Regra 3 não cadastrada',
                         'rule3' => 'Regra 4 não cadastrada',
                         'rule4' => 'Regra 5 não cadastrada',
                         'rule5' => 'Regra 6 não cadastrada',
                         'rule6' => 'Regra 7 não cadastrada',
                         'rule7' => 'Regra 8 não cadastrada',
                         'rule8' => 'Regra 9 não cadastrada',
                         'rule9' => 'Regra 10 não cadastrada'
                    ],
          ],
            JSON_UNESCAPED_UNICODE),
        'created_at' => now(),
        ]);
    }
}
