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
        $terms = json_decode(<<<'JSON'
[
  {
    "term": "Ecossistema IDOA",
    "definition": "Conjunto de sistemas e processos que interagem no ambiente IdoA.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "Habitat",
    "definition": "Sistema que agrupa niches com características semelhantes.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "Niche",
    "definition": "Função ou papel específico dentro de um habitat.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "NEAD",
    "definition": "Núcleo de Educação Aberta e à Distância",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "Rateio",
    "definition": null,
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "Tesauro",
    "definition": "Vocabulário Controlado",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "NEEJACP-DV",
    "definition": "Núcleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Darcy Vargas",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Nível de Ensino (Certificação)",
    "definition": "Exame para Certificação de Competências de Jovens e Adultos.\r\nAtividades, cursos, certificações, etc. realizadas na Instituição.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ensino Fundamental II - Anos Finais",
    "definition": "Certificação do Ensino Fundamental II (Anos Finais)\r\nCompreende do 6º ao 9º ano. \r\nObjetivo principal: aprofundamento dos conhecimentos e sistematização do aprendizado. \r\nDisciplinas: Incluem as áreas de linguagens, matemática, ciências da natureza, ciências humanas. A língua inglesa é introduzida a partir do sexto ano. ",
    "language": "pt_BR",
    "term_data": "{\"documents\":[]}",
    "id_niche": 1
  },
  {
    "term": "Ensino Médio",
    "definition": "Certificação do 1 ao 3 ano do Ensino Médio",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Linguagens - EF",
    "definition": "Avaliação desta área possui competências específicas e agrupa componentes curriculares (disciplinas) de Português, Arte, Educação Física e Inglês a partir do 6º ano",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ciências Humanas - EF",
    "definition": "Avaliação desta área possui competências específicas e agrupa componentes curriculares (disciplinas) de História e Geografia a partir do 6º ano.\r\nEstuda o ser humano em sua relação com o tempo, espaço e sociedade.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ciências da Natureza - EF",
    "definition": "Avaliação desta área possui competências específicas e engloba o componente curricular (disciplina) de Ciências a partir do 6º ano.\r\nEstuda os seres vivos e o meio ambiente.",
    "language": "pt_BR",
    "term_data": "{\"documents\":[]}",
    "id_niche": 1
  },
  {
    "term": "Matemática - EF",
    "definition": "Avaliação desta área possui competências específicas do componente curricular (disciplina) de Matemática a partir do 6º ano.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ensino Fundamental I - Anos Iniciais",
    "definition": "Compreende do 1º ao 5º ano. \r\nObjetivo principal: alfabetização, letramento e desenvolvimento de autonomia intelectual, com foco em situações lúdicas. \r\nDisciplinas comuns: Língua Portuguesa, Matemática, Ciências, História, Geografia, Artes e Educação Física.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Linguagens e suas Tecnologias",
    "definition": "Inclui Língua Portuguesa, Literatura, Língua Inglesa, Artes e Educação Física.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Matemática e suas Tecnologias",
    "definition": "Abrange os estudos de Matemática, com aprofundamento em temas como programação, e a aplicação dos conhecimentos matemáticos no dia a dia.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ciências da Natureza e suas Tecnologias",
    "definition": "Engloba Física, Química e Biologia. Também aborda temas como biotecnologia e o trabalho de investigação científica.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ciências Humanas e Sociais Aplicadas",
    "definition": "Compreende História, Geografia, Filosofia e Sociologia.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Matéria, Energia e suas Transformações",
    "definition": "Neste tópico estuda-se a natureza da matéria (tudo que tem massa e ocupa espaço), os diferentes tipos de energia (mecânica, térmica, elétrica, etc.) e como a energia causa transformações na matéria. Isso inclui entender a diferença entre transformações físicas (como a mudança de estado da água) e transformações químicas (que criam novas substâncias), além dos princípios que regem essas interações, como a conservação da energia.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Propriedades da matéria (massa, volume)",
    "definition": "Neste tópico estuda-se a massa como a quantidade de matéria em um corpo e o volume como o espaço que esse corpo ocupa. Essas propriedades são fundamentais para entender a matéria e são usadas para caracterizar diferentes substâncias, sendo a massa medida em gramas ou quilogramas e o volume em litros ou metros cúbicos.",
    "language": "pt_BR",
    "term_data": "{\"documents\":[\"1_24_o_que_e_materia_2.pdf\",\"1_24_o_que_e_materia_1.pdf\",\"1_24_o_que_e_materia_links.pdf\"]}",
    "id_niche": 1
  },
  {
    "term": "Misturas, soluções e reações químicas",
    "definition": "Neste tópico estuda-se a classificação da matéria em misturas (combinações de substâncias) e soluções (misturas homogêneas), além de como essas substâncias interagem e se transformam em reações químicas.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Estrutura da matéria (átomos e moléculas)",
    "definition": "Neste tópico estuda-se a constituição e organização da matéria a nível atômico e molecular, incluindo a composição de átomos e moléculas, suas propriedades, como se formam as ligações entre eles e os modelos atômicos que descrevem essa estrutura. A disciplina abrange as partículas subatômicas (prótons, nêutrons e elétrons), a forma como se distribuem no núcleo e na eletrosfera, e os diferentes tipos de ligações químicas que unem átomos para formar moléculas.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Produção e propagação de som e luz",
    "definition": "Neste tópico estuda-se a física das ondas, focando nos fenômenos ondulatórios de som (ondas mecânicas) e luz (ondas eletromagnéticas). Isso inclui como as ondas são geradas, suas propriedades (como frequência, amplitude e velocidade), e como interagem com diferentes meios através de fenômenos como reflexão, refração, difração e interferência.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Fontes de energia (renováveis e não-renováveis) e sua transformação em energia elétrica",
    "definition": "Neste tópico estuda-se a classificação de fontes de energia (renováveis como solar, eólica, hídrica e biomassa; e não-renováveis como petróleo, carvão e gás natural) e os processos de sua conversão em energia elétrica, incluindo a física por trás dessas transformações, como o uso de turbinas em hidrelétricas ou painéis solares fotovoltaicos, e também as suas implicações ambientais e econômicas",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Circuitos elétricos e seus componentes",
    "definition": "Neste tópico estuda-se a eletrodinâmica, que envolve o fluxo de cargas elétricas, e os componentes essenciais que criam um caminho fechado para a corrente. Os conceitos centrais incluem a lei de Ohm (V=IR), a relação entre tensão (V), corrente (I) e resistência (R).",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Vida, Ambiente e Saúde",
    "definition": "Neste tópico estuda-se a complexa relação entre os seres vivos (incluindo humanos), o meio ambiente e a saúde individual e coletiva. A área abrange desde os impactos da poluição e alterações ambientais na saúde até os efeitos de doenças emergentes e a busca por soluções sustentáveis. Inclui o estudo de doenças causadas por fatores ambientais, a influência do ambiente na qualidade de vida e as interações ecológicas com a saúde humana.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "O corpo humano: estrutura, hábitos de higiene e sistemas (nervoso, muscular, esquelético).",
    "definition": "Neste tópico estuda-se a anatomia (estrutura e forma do corpo), a fisiologia (funcionamento dos sistemas) e a relação entre eles e os hábitos de higiene. A disciplina abrange o estudo da estrutura geral, as partes do corpo (cabeça, tronco e membros) e os sistemas específicos, como o nervoso, muscular e esquelético. Os hábitos de higiene são abordados para entender como a limpeza e o cuidado com o corpo afetam sua saúde e funcionamento.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Drogas e seus efeitos no organismo",
    "definition": "As drogas atuam no sistema nervoso central (SNC) do ser humano das mais diversas maneiras, podendo funcionar como depressoras, estimulantes ou até mesmo perturbadoras do SNC. São essas ações que ditam a forma como a substância irá alterar a percepção e outras funções cognitivas importantes do paciente.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Reprodução humana, sexualidade e métodos contraceptivos.",
    "definition": "Neste tópico estuda-se a anatomia e fisiologia dos sistemas reprodutores masculino e feminino, o ciclo menstrual e a ovulação, os diferentes tipos de métodos contraceptivos (incluindo seus mecanismos, eficácia e desvantagens) e as DSTs (Doenças Sexualmente Transmissíveis). Também aborda a saúde sexual e reprodutiva de forma ampla, incluindo aspectos psicossociais, direitos, puberdade e a importância do planejamento familiar e da prevenção de gravidez indesejada.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Infecções sexualmente transmissíveis (ISTs)",
    "definition": "Este tópico aborda o diagnóstico, tratamento, prevenção e as consequências das infecções causadas por vírus, bactérias ou outros parasitas. Isso inclui o conhecimento sobre os agentes etiológicos (causadores), os mecanismos de transmissão, a análise de sintomas e fatores de risco, além da criação de estratégias de prevenção e promoção da saúde sexual.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ecossistemas, biomas e biodiversidade",
    "definition": "Neste tópico estuda-se as interações entre os seres vivos e o ambiente, a variedade de vida em diferentes regiões e os grandes sistemas naturais que compartilham características climáticas e de vegetação.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Ecologia e sustentabilidade",
    "definition": "Neste tópico estuda-se a interação entre os seres vivos e o meio ambiente, além de como utilizar os recursos naturais de forma que não comprometa as futuras gerações. Isso inclui a análise de cadeias alimentares, ciclos biogeoquímicos, dinâmica de populações, conservação ambiental e o desenvolvimento de soluções para problemas socioambientais. O campo também abrange os três pilares da sustentabilidade: social, econômico e ambiental, que devem estar em equilíbrio.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Terra e Universo",
    "definition": "Neste tópico estuda-se a Terra (sua estrutura interna, atmosfera e movimentos), o Sistema Solar (Sol, planetas, satélites, asteroides, cometas) e o Universo em sua totalidade, incluindo estrelas, galáxias e a origem e evolução desses corpos celestes. Os temas também abrangem as forças que atuam entre os astros, como a gravidade, e os fenômenos naturais relacionados a eles, como as estações do ano, marés e o ciclo dia/noite.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "O movimento aparente do Sol e as sombras",
    "definition": "Neste tópico estuda-se a relação entre a rotação da Terra, que causa a impressão de que o Sol se move no céu, e a mudança no tamanho e na posição das sombras ao longo do dia. A posição do Sol muda de leste para oeste (mais alto ao meio-dia, mais baixo no início da manhã e fim da tarde) devido ao movimento de rotação, o que faz com que as sombras se alterem.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "O Sol como fonte de luz e calor",
    "definition": "Neste tópico estuda-se a importância do Sol para a vida na Terra, como ele produz sua energia através da fusão nuclear e a relação entre a radiação solar e processos naturais como a fotossíntese, o clima e o corpo humano. Também se aborda o estudo dos efeitos da luz e do calor do Sol em diferentes superfícies e a observação das mudanças na sombra ao longo do dia.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "O sistema solar, planetas e estrelas",
    "definition": "Neste tópico estudamos a astronomia, que aborda a estrutura e composição do Sistema Solar, incluindo os planetas (rochosos e gasosos), o Sol, satélites naturais (como a Lua), asteroides e cometas. Também se estuda a formação, evolução, características e interações desses corpos celestes, e a posição do nosso Sistema Solar dentro da Via Láctea e do Universo.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "A origem do sistema solar e da vida na Terra",
    "definition": "Envolve Astronomia, Astrofísica e Biologia, investigando a formação de estrelas e planetas a partir de nuvens de gás e poeira (nebulosa solar), a composição e evolução da Terra primitiva, e as teorias sobre como as primeiras moléculas orgânicas se formaram em uma \"sopa primitiva\" para dar origem aos primeiros seres vivos, focando em processos como a Nebulosa Solar, Astrobiologia, e Teorias de Oparin-Haldane.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "As rochas, fósseis e a atmosfera terrestre",
    "definition": "Estudar rochas, fósseis e a atmosfera terrestre envolve a Geologia (rochas, formação da Terra), a Paleontologia (fósseis, evolução da vida), a Meteorologia/Climatologia (atmosfera, clima) e a Geografia Física, focando na estrutura do planeta, nos ciclos (carbono, água), nas eras geológicas e na interação entre processos naturais e a vida, essencial para entender o passado e presente do nosso planeta.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "O clima, fenômenos meteorológicos e previsão do tempo",
    "definition": "Estuda-se a Meteorologia, a ciência que analisa a atmosfera para entender o tempo (condição momentânea), o clima (padrão de longo prazo), os fenômenos atmosféricos (chuva, vento, neve, tempestades) e usar modelos físicos e computacionais para prever as mudanças futuras, sendo fundamental para agricultura, aviação, gestão de recursos hídricos e até saúde humana, aplicando física, matemática e química para interpretar dados e tendências globais.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Movimentos da Terra, como rotação e translação.",
    "definition": "Envolve entender como a Terra gira em torno de seu próprio eixo (rotação) e ao redor do Sol (translação) para compreender as consequências que afetam a vida no planeta: a sucessão de dias e noites, a duração do ano, as estações do ano (primavera, verão, outono, inverno), os solstícios e equinócios, e até a organização dos fusos horários, além de fenômenos como a Força de Coriolis, que influencia ventos e correntes marítimas.",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 1
  },
  {
    "term": "Português e Matemática",
    "definition": "Séries Inciais do Ensino Fundamenal - Avaliação de escolaridade.",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 1
  },
  {
    "term": "RATEIO",
    "definition": "Termo Genérico (raiz ou inicial) deste nicho",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 3
  },
  {
    "term": "UFCSPA-5",
    "definition": "Primeiro termo específico deste nicho",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 3
  },
  {
    "term": "RATEIO",
    "definition": "Termo Genérico (raiz ou inicial) deste nicho",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 4
  },
  {
    "term": "DIPP-5",
    "definition": "Primeiro termo específico deste nicho",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 4
  },
  {
    "term": "NEAD",
    "definition": "Termo Genérico (raiz ou inicial) deste nicho",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 2
  },
  {
    "term": "NEEJACP-PF",
    "definition": "Termo específico inicial do Habitat NEAD",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 2
  },
  {
    "term": "Nível de Ensino - PF",
    "definition": "Exame para Certificação de Competências de Jovens e Adultos.\r\nAtividades, cursos, certificações, etc, realizadas na Instituição.",
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 2
  },
  {
    "term": "NEAD",
    "definition": null,
    "language": "pt_BR",
    "term_data": "{\"document\":[]}",
    "id_niche": 1
  },
  {
    "term": "IDOA-TES",
    "definition": "Primeiro termo específico deste nicho",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "UFCSPA-5",
    "definition": "Termo do Nicho 5",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "DIPP-5",
    "definition": "Termo do nicho 5",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "NEEJACP-DV",
    "definition": "Termo do nicho 5",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "NEEJACP-PF",
    "definition": "Termo do nicho 5",
    "language": "pt_BR",
    "term_data": null,
    "id_niche": 5
  },
  {
    "term": "ufcspa5_44_00001",
    "definition": "Rateio 01 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,24,29,57,61],\"concourseCEFNumber\":\"7021\",\"concourseCEFDate\":\"2026-05-09\",\"totalRateio\":2,\"totalPrize\":2,\"availableBalance_Next\":1.6,\"availableBalance_Final5\":0.2,\"availableBalance_Special\":0.2,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":1,\"value_4_hits\":0.3,\"value_3_hits\":0.2,\"value_2_hits\":0.1,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00002",
    "definition": "Rateio 02 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[30,38,47,50,68],\"concourseCEFNumber\":\"7022\",\"concourseCEFDate\":\"2026-05-11\",\"totalRateio\":2,\"totalPrize\":3.6,\"availableBalance_Next\":2.88,\"availableBalance_Final5\":0.56,\"availableBalance_Special\":0.56,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":1.8,\"value_4_hits\":0.54,\"value_3_hits\":0.36000000000000004,\"value_2_hits\":0.18000000000000002,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00003",
    "definition": "Rateio 03 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[16,35,44,66,78],\"concourseCEFNumber\":\"7023\",\"concourseCEFDate\":\"2026-05-12\",\"totalRateio\":2,\"totalPrize\":4.88,\"availableBalance_Next\":3.904,\"availableBalance_Final5\":1.048,\"availableBalance_Special\":1.048,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":2.44,\"value_4_hits\":0.732,\"value_3_hits\":0.488,\"value_2_hits\":0.244,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00004",
    "definition": "Rateio 04 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[2,38,43,48,74],\"concourseCEFNumber\":\"7024\",\"concourseCEFDate\":\"2026-05-13\",\"totalRateio\":2,\"totalPrize\":5.904,\"availableBalance_Next\":4.7232,\"availableBalance_Final5\":1.6384,\"availableBalance_Special\":1.6384,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2,4],\"value_5_hits\":2.952,\"value_4_hits\":0.8855999999999999,\"value_3_hits\":0.5904,\"value_2_hits\":0.2952,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00005",
    "definition": "Rateio 05 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[14,27,29,50,57],\"concourseCEFNumber\":\"7025\",\"concourseCEFDate\":\"2026-05-14\",\"totalRateio\":2,\"totalPrize\":8.3616,\"availableBalance_Next\":8.361599999999997,\"availableBalance_Final5\":0,\"availableBalance_Special\":1.6384,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":5.853119999999999,\"value_4_hits\":1.2542399999999998,\"value_3_hits\":0.83616,\"value_2_hits\":0.41808,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00006",
    "definition": "Rateio 06 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[19,51,55,57,70],\"concourseCEFNumber\":\"7026\",\"concourseCEFDate\":\"2026-05-15\",\"totalRateio\":2,\"totalPrize\":10.361599999999997,\"availableBalance_Next\":8.289279999999998,\"availableBalance_Final5\":1.0361599999999997,\"availableBalance_Special\":2.6745599999999996,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.180799999999999,\"value_4_hits\":1.5542399999999996,\"value_3_hits\":1.0361599999999997,\"value_2_hits\":0.5180799999999999,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00007",
    "definition": "Rateio 07 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[24,27,34,44,47],\"concourseCEFNumber\":\"7027\",\"concourseCEFDate\":\"2026-05-16\",\"totalRateio\":2,\"totalPrize\":10.289279999999998,\"availableBalance_Next\":8.231423999999999,\"availableBalance_Final5\":2.0650879999999994,\"availableBalance_Special\":3.7034879999999992,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.144639999999999,\"value_4_hits\":1.5433919999999997,\"value_3_hits\":1.0289279999999998,\"value_2_hits\":0.5144639999999999,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00008",
    "definition": "Rateio 08 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,16,41,42,74],\"concourseCEFNumber\":\"7028\",\"concourseCEFDate\":\"2026-05-18\",\"totalRateio\":2,\"totalPrize\":10.231423999999999,\"availableBalance_Next\":8.1851392,\"availableBalance_Final5\":3.0882303999999996,\"availableBalance_Special\":4.7266303999999995,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":5.115711999999999,\"value_4_hits\":1.5347135999999997,\"value_3_hits\":1.0231424,\"value_2_hits\":0.5115712,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00009",
    "definition": "Rateio 09 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[13,14,17,20,59],\"concourseCEFNumber\":\"7029\",\"concourseCEFDate\":\"2026-05-19\",\"totalRateio\":2,\"totalPrize\":10.1851392,\"availableBalance_Next\":8.14811136,\"availableBalance_Final5\":4.10674432,\"availableBalance_Special\":5.74514432,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.0925696,\"value_4_hits\":1.52777088,\"value_3_hits\":1.01851392,\"value_2_hits\":0.50925696,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00010",
    "definition": "Rateio 10 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[16,19,24,50,55],\"concourseCEFNumber\":\"7030\",\"concourseCEFDate\":\"2026-05-20\",\"totalRateio\":2,\"totalPrize\":10.14811136,\"availableBalance_Next\":8.118489087999999,\"availableBalance_Final5\":5.121555455999999,\"availableBalance_Special\":6.759955456,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":5.07405568,\"value_4_hits\":1.5222167039999999,\"value_3_hits\":1.014811136,\"value_2_hits\":0.507405568,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00011",
    "definition": "Rateio 11 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[3,12,40,56,70],\"concourseCEFNumber\":\"7031\",\"concourseCEFDate\":\"2026-05-21\",\"totalRateio\":2,\"totalPrize\":10.118489087999999,\"availableBalance_Next\":7.082942361599999,\"availableBalance_Final5\":6.1334043648,\"availableBalance_Special\":7.7718043648,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[2,4],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.059244543999999,\"value_4_hits\":1.5177733631999997,\"value_3_hits\":1.0118489088,\"value_2_hits\":0.5059244544,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00012",
    "definition": "Rateio 12 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[5,28,48,49,71],\"concourseCEFNumber\":\"7032\",\"concourseCEFDate\":\"2026-05-22\",\"totalRateio\":2,\"totalPrize\":9.082942361599999,\"availableBalance_Next\":7.266353889279999,\"availableBalance_Final5\":7.041698600959999,\"availableBalance_Special\":8.680098600960001,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":4.5414711807999995,\"value_4_hits\":1.3624413542399998,\"value_3_hits\":0.9082942361599999,\"value_2_hits\":0.45414711807999997,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00013",
    "definition": "Rateio 13 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,29,32,33,56],\"concourseCEFNumber\":\"7033\",\"concourseCEFDate\":\"2026-05-23\",\"totalRateio\":2,\"totalPrize\":9.266353889279998,\"availableBalance_Next\":7.413083111423998,\"availableBalance_Final5\":7.9683339898879995,\"availableBalance_Special\":9.606733989888001,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":4.633176944639999,\"value_4_hits\":1.3899530833919995,\"value_3_hits\":0.9266353889279998,\"value_2_hits\":0.4633176944639999,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00014",
    "definition": "Rateio 14 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[12,21,74,77,79],\"concourseCEFNumber\":\"7034\",\"concourseCEFDate\":\"2026-05-25\",\"totalRateio\":2,\"totalPrize\":9.413083111423997,\"availableBalance_Next\":7.530466489139198,\"availableBalance_Final5\":8.909642301030399,\"availableBalance_Special\":10.548042301030401,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2,4],\"value_5_hits\":4.706541555711999,\"value_4_hits\":1.4119624667135995,\"value_3_hits\":0.9413083111423998,\"value_2_hits\":0.4706541555711999,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00015",
    "definition": "Rateio 15 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[14,15,48,58,73],\"concourseCEFNumber\":\"7035\",\"concourseCEFDate\":\"2026-05-26\",\"totalRateio\":2,\"totalPrize\":18.440108790169596,\"availableBalance_Next\":18.440108790169596,\"availableBalance_Final5\":0,\"availableBalance_Special\":10.548042301030401,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":12.908076153118717,\"value_4_hits\":2.7660163185254394,\"value_3_hits\":1.8440108790169596,\"value_2_hits\":0.9220054395084798,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00016",
    "definition": "Rateio 16 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[15,42,63,66,77],\"concourseCEFNumber\":\"7036\",\"concourseCEFDate\":\"2026-05-27\",\"totalRateio\":2,\"totalPrize\":20.440108790169596,\"availableBalance_Next\":16.352087032135675,\"availableBalance_Final5\":2.0440108790169598,\"availableBalance_Special\":12.592053180047362,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":10.220054395084798,\"value_4_hits\":3.066016318525439,\"value_3_hits\":2.0440108790169598,\"value_2_hits\":1.0220054395084799,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00017",
    "definition": "Rateio 17 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[9,26,42,55,66],\"concourseCEFNumber\":\"7037\",\"concourseCEFDate\":\"2026-05-28\",\"totalRateio\":2,\"totalPrize\":18.352087032135675,\"availableBalance_Next\":14.681669625708539,\"availableBalance_Final5\":3.8792195822305273,\"availableBalance_Special\":14.427261883260929,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":9.176043516067837,\"value_4_hits\":2.752813054820351,\"value_3_hits\":1.8352087032135675,\"value_2_hits\":0.9176043516067838,\"value_1_hits\":0}]}",
    "id_niche": 3
  },
  {
    "term": "ufcspa5_44_00018",
    "definition": "Rateio 18 do termo BT 44",
    "language": "pt_BR",
    "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[2,31,39,64,73],\"concourseCEFNumber\":\"7038\",\"concourseCEFDate\":\"2026-05-29\",\"totalRateio\":2,\"totalPrize\":16.681669625708537,\"availableBalance_Next\":13.34533570056683,\"availableBalance_Final5\":5.547386544801381,\"availableBalance_Special\":16.095428845831783,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":8.340834812854268,\"value_4_hits\":2.5022504438562803,\"value_3_hits\":1.6681669625708537,\"value_2_hits\":0.8340834812854269,\"value_1_hits\":0}]}",
    "id_niche": 3
  }
]
JSON
, true);

        $now = now();
        $rows = array_map(static function (array $term) use ($now): array {
            if (array_key_exists('term_data', $term)) {
                $termData = $term['term_data'];

                if (is_string($termData)) {
                    $termData = trim($termData);

                    if ($termData === '') {
                        $term['term_data'] = null;
                        $termData = null;
                    } else {
                        $decodedTermData = json_decode($termData, true);
                        if (json_last_error() === JSON_ERROR_NONE) {
                            $termData = $decodedTermData;
                        }
                    }
                }

                if (is_array($termData) || is_object($termData)) {
                    $encodedTermData = json_encode($termData, JSON_UNESCAPED_UNICODE);
                    $term['term_data'] = $encodedTermData === false ? null : $encodedTermData;
                }
            }

            $term['created_at'] = $now;
            $term['updated_at'] = $now;

            return $term;
        }, $terms);

        DB::table('terms')->insert($rows);
    }
}
