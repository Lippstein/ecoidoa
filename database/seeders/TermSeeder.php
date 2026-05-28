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
        "definition": "Sistema que agrupa niches com caracter\u00edsticas semelhantes.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 5
    },
    {
        "term": "Niche",
        "definition": "Fun\u00e7\u00e3o ou papel espec\u00edfico dentro de um habitat.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 5
    },
    {
        "term": "NEAD",
        "definition": "N\u00facleo de Educa\u00e7\u00e3o Aberta e \u00e0 Dist\u00e2ncia",
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
        "definition": "Vocabul\u00e1rio Controlado",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 5
    },
    {
        "term": "NEEJACP-DV",
        "definition": "N\u00facleo Estadual de Ensino de Jovens e Adultos e de Cultura Popular Darcy Vargas",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "N\u00edvel de Ensino (Certifica\u00e7\u00e3o)",
        "definition": "Exame para Certifica\u00e7\u00e3o de Compet\u00eancias de Jovens e Adultos.\r\nAtividades, cursos, certifica\u00e7\u00f5es, etc. realizadas na Institui\u00e7\u00e3o.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ensino Fundamental II - Anos Finais",
        "definition": "Certifica\u00e7\u00e3o do Ensino Fundamental II (Anos Finais)\r\nCompreende do 6\u00ba ao 9\u00ba ano. \r\nObjetivo principal: aprofundamento dos conhecimentos e sistematiza\u00e7\u00e3o do aprendizado. \r\nDisciplinas: Incluem as \u00e1reas de linguagens, matem\u00e1tica, ci\u00eancias da natureza, ci\u00eancias humanas. A l\u00edngua inglesa \u00e9 introduzida a partir do sexto ano. ",
        "language": "pt_BR",
        "term_data": "{\"documents\":[]}",
        "id_niche": 1
    },
    {
        "term": "Ensino M\u00e9dio",
        "definition": "Certifica\u00e7\u00e3o do 1 ao 3 ano do Ensino M\u00e9dio",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Linguagens - EF",
        "definition": "Avalia\u00e7\u00e3o desta \u00e1rea possui compet\u00eancias espec\u00edficas e agrupa componentes curriculares (disciplinas) de Portugu\u00eas, Arte, Educa\u00e7\u00e3o F\u00edsica e Ingl\u00eas a partir do 6\u00ba ano",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ci\u00eancias Humanas - EF",
        "definition": "Avalia\u00e7\u00e3o desta \u00e1rea possui compet\u00eancias espec\u00edficas e agrupa componentes curriculares (disciplinas) de Hist\u00f3ria e Geografia a partir do 6\u00ba ano.\r\nEstuda o ser humano em sua rela\u00e7\u00e3o com o tempo, espa\u00e7o e sociedade.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ci\u00eancias da Natureza - EF",
        "definition": "Avalia\u00e7\u00e3o desta \u00e1rea possui compet\u00eancias espec\u00edficas e engloba o componente curricular (disciplina) de Ci\u00eancias a partir do 6\u00ba ano.\r\nEstuda os seres vivos e o meio ambiente.",
        "language": "pt_BR",
        "term_data": "{\"documents\":[]}",
        "id_niche": 1
    },
    {
        "term": "Matem\u00e1tica - EF",
        "definition": "Avalia\u00e7\u00e3o desta \u00e1rea possui compet\u00eancias espec\u00edficas do componente curricular (disciplina) de Matem\u00e1tica a partir do 6\u00ba ano.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ensino Fundamental I - Anos Iniciais",
        "definition": "Compreende do 1\u00ba ao 5\u00ba ano. \r\nObjetivo principal: alfabetiza\u00e7\u00e3o, letramento e desenvolvimento de autonomia intelectual, com foco em situa\u00e7\u00f5es l\u00fadicas. \r\nDisciplinas comuns: L\u00edngua Portuguesa, Matem\u00e1tica, Ci\u00eancias, Hist\u00f3ria, Geografia, Artes e Educa\u00e7\u00e3o F\u00edsica.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "aaaaa111",
        "definition": "tipo",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Linguagens e suas Tecnologias",
        "definition": "Inclui L\u00edngua Portuguesa, Literatura, L\u00edngua Inglesa, Artes e Educa\u00e7\u00e3o F\u00edsica.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Matem\u00e1tica e suas Tecnologias",
        "definition": "Abrange os estudos de Matem\u00e1tica, com aprofundamento em temas como programa\u00e7\u00e3o, e a aplica\u00e7\u00e3o dos conhecimentos matem\u00e1ticos no dia a dia.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ci\u00eancias da Natureza e suas Tecnologias",
        "definition": "Engloba F\u00edsica, Qu\u00edmica e Biologia. Tamb\u00e9m aborda temas como biotecnologia e o trabalho de investiga\u00e7\u00e3o cient\u00edfica.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ci\u00eancias Humanas e Sociais Aplicadas",
        "definition": "Compreende Hist\u00f3ria, Geografia, Filosofia e Sociologia.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Mat\u00e9ria, Energia e suas Transforma\u00e7\u00f5es",
        "definition": "Neste t\u00f3pico estuda-se a natureza da mat\u00e9ria (tudo que tem massa e ocupa espa\u00e7o), os diferentes tipos de energia (mec\u00e2nica, t\u00e9rmica, el\u00e9trica, etc.) e como a energia causa transforma\u00e7\u00f5es na mat\u00e9ria. Isso inclui entender a diferen\u00e7a entre transforma\u00e7\u00f5es f\u00edsicas (como a mudan\u00e7a de estado da \u00e1gua) e transforma\u00e7\u00f5es qu\u00edmicas (que criam novas subst\u00e2ncias), al\u00e9m dos princ\u00edpios que regem essas intera\u00e7\u00f5es, como a conserva\u00e7\u00e3o da energia.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Propriedades da mat\u00e9ria (massa, volume)",
        "definition": "Neste t\u00f3pico estuda-se a massa como a quantidade de mat\u00e9ria em um corpo e o volume como o espa\u00e7o que esse corpo ocupa. Essas propriedades s\u00e3o fundamentais para entender a mat\u00e9ria e s\u00e3o usadas para caracterizar diferentes subst\u00e2ncias, sendo a massa medida em gramas ou quilogramas e o volume em litros ou metros c\u00fabicos.",
        "language": "pt_BR",
        "term_data": "{\"documents\":[\"1_24_o_que_e_materia_2.pdf\",\"1_24_o_que_e_materia_1.pdf\",\"1_24_o_que_e_materia_links.pdf\"]}",
        "id_niche": 1
    },
    {
        "term": "Misturas, solu\u00e7\u00f5es e rea\u00e7\u00f5es qu\u00edmicas",
        "definition": "Neste t\u00f3pico estuda-se a classifica\u00e7\u00e3o da mat\u00e9ria em misturas (combina\u00e7\u00f5es de subst\u00e2ncias) e solu\u00e7\u00f5es (misturas homog\u00eaneas), al\u00e9m de como essas subst\u00e2ncias interagem e se transformam em rea\u00e7\u00f5es qu\u00edmicas.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Estrutura da mat\u00e9ria (\u00e1tomos e mol\u00e9culas)",
        "definition": "Neste t\u00f3pico estuda-se a constitui\u00e7\u00e3o e organiza\u00e7\u00e3o da mat\u00e9ria a n\u00edvel at\u00f4mico e molecular, incluindo a composi\u00e7\u00e3o de \u00e1tomos e mol\u00e9culas, suas propriedades, como se formam as liga\u00e7\u00f5es entre eles e os modelos at\u00f4micos que descrevem essa estrutura. A disciplina abrange as part\u00edculas subat\u00f4micas (pr\u00f3tons, n\u00eautrons e el\u00e9trons), a forma como se distribuem no n\u00facleo e na eletrosfera, e os diferentes tipos de liga\u00e7\u00f5es qu\u00edmicas que unem \u00e1tomos para formar mol\u00e9culas.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Produ\u00e7\u00e3o e propaga\u00e7\u00e3o de som e luz",
        "definition": "Neste t\u00f3pico estuda-se a f\u00edsica das ondas, focando nos fen\u00f4menos ondulat\u00f3rios de som (ondas mec\u00e2nicas) e luz (ondas eletromagn\u00e9ticas). Isso inclui como as ondas s\u00e3o geradas, suas propriedades (como frequ\u00eancia, amplitude e velocidade), e como interagem com diferentes meios atrav\u00e9s de fen\u00f4menos como reflex\u00e3o, refra\u00e7\u00e3o, difra\u00e7\u00e3o e interfer\u00eancia.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Fontes de energia (renov\u00e1veis e n\u00e3o-renov\u00e1veis) e sua transforma\u00e7\u00e3o em energia el\u00e9trica",
        "definition": "Neste t\u00f3pico estuda-se a classifica\u00e7\u00e3o de fontes de energia (renov\u00e1veis como solar, e\u00f3lica, h\u00eddrica e biomassa; e n\u00e3o-renov\u00e1veis como petr\u00f3leo, carv\u00e3o e g\u00e1s natural) e os processos de sua convers\u00e3o em energia el\u00e9trica, incluindo a f\u00edsica por tr\u00e1s dessas transforma\u00e7\u00f5es, como o uso de turbinas em hidrel\u00e9tricas ou pain\u00e9is solares fotovoltaicos, e tamb\u00e9m as suas implica\u00e7\u00f5es ambientais e econ\u00f4micas",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Circuitos el\u00e9tricos e seus componentes",
        "definition": "Neste t\u00f3pico estuda-se a eletrodin\u00e2mica, que envolve o fluxo de cargas el\u00e9tricas, e os componentes essenciais que criam um caminho fechado para a corrente. Os conceitos centrais incluem a lei de Ohm (V=IR), a rela\u00e7\u00e3o entre tens\u00e3o (V), corrente (I) e resist\u00eancia (R).",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Vida, Ambiente e Sa\u00fade",
        "definition": "Neste t\u00f3pico estuda-se a complexa rela\u00e7\u00e3o entre os seres vivos (incluindo humanos), o meio ambiente e a sa\u00fade individual e coletiva. A \u00e1rea abrange desde os impactos da polui\u00e7\u00e3o e altera\u00e7\u00f5es ambientais na sa\u00fade at\u00e9 os efeitos de doen\u00e7as emergentes e a busca por solu\u00e7\u00f5es sustent\u00e1veis. Inclui o estudo de doen\u00e7as causadas por fatores ambientais, a influ\u00eancia do ambiente na qualidade de vida e as intera\u00e7\u00f5es ecol\u00f3gicas com a sa\u00fade humana.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "O corpo humano: estrutura, h\u00e1bitos de higiene e sistemas (nervoso, muscular, esquel\u00e9tico).",
        "definition": "Neste t\u00f3pico estuda-se a anatomia (estrutura e forma do corpo), a fisiologia (funcionamento dos sistemas) e a rela\u00e7\u00e3o entre eles e os h\u00e1bitos de higiene. A disciplina abrange o estudo da estrutura geral, as partes do corpo (cabe\u00e7a, tronco e membros) e os sistemas espec\u00edficos, como o nervoso, muscular e esquel\u00e9tico. Os h\u00e1bitos de higiene s\u00e3o abordados para entender como a limpeza e o cuidado com o corpo afetam sua sa\u00fade e funcionamento.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Drogas e seus efeitos no organismo",
        "definition": "As drogas atuam no sistema nervoso central (SNC) do ser humano das mais diversas maneiras, podendo funcionar como depressoras, estimulantes ou at\u00e9 mesmo perturbadoras do SNC. S\u00e3o essas a\u00e7\u00f5es que ditam a forma como a subst\u00e2ncia ir\u00e1 alterar a percep\u00e7\u00e3o e outras fun\u00e7\u00f5es cognitivas importantes do paciente.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Reprodu\u00e7\u00e3o humana, sexualidade e m\u00e9todos contraceptivos.",
        "definition": "Neste t\u00f3pico estuda-se a anatomia e fisiologia dos sistemas reprodutores masculino e feminino, o ciclo menstrual e a ovula\u00e7\u00e3o, os diferentes tipos de m\u00e9todos contraceptivos (incluindo seus mecanismos, efic\u00e1cia e desvantagens) e as DSTs (Doen\u00e7as Sexualmente Transmiss\u00edveis). Tamb\u00e9m aborda a sa\u00fade sexual e reprodutiva de forma ampla, incluindo aspectos psicossociais, direitos, puberdade e a import\u00e2ncia do planejamento familiar e da preven\u00e7\u00e3o de gravidez indesejada.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Infec\u00e7\u00f5es sexualmente transmiss\u00edveis (ISTs)",
        "definition": "Este t\u00f3pico aborda o diagn\u00f3stico, tratamento, preven\u00e7\u00e3o e as consequ\u00eancias das infec\u00e7\u00f5es causadas por v\u00edrus, bact\u00e9rias ou outros parasitas. Isso inclui o conhecimento sobre os agentes etiol\u00f3gicos (causadores), os mecanismos de transmiss\u00e3o, a an\u00e1lise de sintomas e fatores de risco, al\u00e9m da cria\u00e7\u00e3o de estrat\u00e9gias de preven\u00e7\u00e3o e promo\u00e7\u00e3o da sa\u00fade sexual.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ecossistemas, biomas e biodiversidade",
        "definition": "Neste t\u00f3pico estuda-se as intera\u00e7\u00f5es entre os seres vivos e o ambiente, a variedade de vida em diferentes regi\u00f5es e os grandes sistemas naturais que compartilham caracter\u00edsticas clim\u00e1ticas e de vegeta\u00e7\u00e3o.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Ecologia e sustentabilidade",
        "definition": "Neste t\u00f3pico estuda-se a intera\u00e7\u00e3o entre os seres vivos e o meio ambiente, al\u00e9m de como utilizar os recursos naturais de forma que n\u00e3o comprometa as futuras gera\u00e7\u00f5es. Isso inclui a an\u00e1lise de cadeias alimentares, ciclos biogeoqu\u00edmicos, din\u00e2mica de popula\u00e7\u00f5es, conserva\u00e7\u00e3o ambiental e o desenvolvimento de solu\u00e7\u00f5es para problemas socioambientais. O campo tamb\u00e9m abrange os tr\u00eas pilares da sustentabilidade: social, econ\u00f4mico e ambiental, que devem estar em equil\u00edbrio.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Terra e Universo",
        "definition": "Neste t\u00f3pico estuda-se a Terra (sua estrutura interna, atmosfera e movimentos), o Sistema Solar (Sol, planetas, sat\u00e9lites, asteroides, cometas) e o Universo em sua totalidade, incluindo estrelas, gal\u00e1xias e a origem e evolu\u00e7\u00e3o desses corpos celestes. Os temas tamb\u00e9m abrangem as for\u00e7as que atuam entre os astros, como a gravidade, e os fen\u00f4menos naturais relacionados a eles, como as esta\u00e7\u00f5es do ano, mar\u00e9s e o ciclo dia\/noite.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "O movimento aparente do Sol e as sombras",
        "definition": "Neste t\u00f3pico estuda-se a rela\u00e7\u00e3o entre a rota\u00e7\u00e3o da Terra, que causa a impress\u00e3o de que o Sol se move no c\u00e9u, e a mudan\u00e7a no tamanho e na posi\u00e7\u00e3o das sombras ao longo do dia. A posi\u00e7\u00e3o do Sol muda de leste para oeste (mais alto ao meio-dia, mais baixo no in\u00edcio da manh\u00e3 e fim da tarde) devido ao movimento de rota\u00e7\u00e3o, o que faz com que as sombras se alterem.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "O Sol como fonte de luz e calor",
        "definition": "Neste t\u00f3pico estuda-se a import\u00e2ncia do Sol para a vida na Terra, como ele produz sua energia atrav\u00e9s da fus\u00e3o nuclear e a rela\u00e7\u00e3o entre a radia\u00e7\u00e3o solar e processos naturais como a fotoss\u00edntese, o clima e o corpo humano. Tamb\u00e9m se aborda o estudo dos efeitos da luz e do calor do Sol em diferentes superf\u00edcies e a observa\u00e7\u00e3o das mudan\u00e7as na sombra ao longo do dia.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "O sistema solar, planetas e estrelas",
        "definition": "Neste t\u00f3pico estudamos a astronomia, que aborda a estrutura e composi\u00e7\u00e3o do Sistema Solar, incluindo os planetas (rochosos e gasosos), o Sol, sat\u00e9lites naturais (como a Lua), asteroides e cometas. Tamb\u00e9m se estuda a forma\u00e7\u00e3o, evolu\u00e7\u00e3o, caracter\u00edsticas e intera\u00e7\u00f5es desses corpos celestes, e a posi\u00e7\u00e3o do nosso Sistema Solar dentro da Via L\u00e1ctea e do Universo.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "A origem do sistema solar e da vida na Terra",
        "definition": "Envolve Astronomia, Astrof\u00edsica e Biologia, investigando a forma\u00e7\u00e3o de estrelas e planetas a partir de nuvens de g\u00e1s e poeira (nebulosa solar), a composi\u00e7\u00e3o e evolu\u00e7\u00e3o da Terra primitiva, e as teorias sobre como as primeiras mol\u00e9culas org\u00e2nicas se formaram em uma \"sopa primitiva\" para dar origem aos primeiros seres vivos, focando em processos como a Nebulosa Solar, Astrobiologia, e Teorias de Oparin-Haldane.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "As rochas, f\u00f3sseis e a atmosfera terrestre",
        "definition": "Estudar rochas, f\u00f3sseis e a atmosfera terrestre envolve a Geologia (rochas, forma\u00e7\u00e3o da Terra), a Paleontologia (f\u00f3sseis, evolu\u00e7\u00e3o da vida), a Meteorologia\/Climatologia (atmosfera, clima) e a Geografia F\u00edsica, focando na estrutura do planeta, nos ciclos (carbono, \u00e1gua), nas eras geol\u00f3gicas e na intera\u00e7\u00e3o entre processos naturais e a vida, essencial para entender o passado e presente do nosso planeta.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "O clima, fen\u00f4menos meteorol\u00f3gicos e previs\u00e3o do tempo",
        "definition": "Estuda-se a Meteorologia, a ci\u00eancia que analisa a atmosfera para entender o tempo (condi\u00e7\u00e3o moment\u00e2nea), o clima (padr\u00e3o de longo prazo), os fen\u00f4menos atmosf\u00e9ricos (chuva, vento, neve, tempestades) e usar modelos f\u00edsicos e computacionais para prever as mudan\u00e7as futuras, sendo fundamental para agricultura, avia\u00e7\u00e3o, gest\u00e3o de recursos h\u00eddricos e at\u00e9 sa\u00fade humana, aplicando f\u00edsica, matem\u00e1tica e qu\u00edmica para interpretar dados e tend\u00eancias globais.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Movimentos da Terra, como rota\u00e7\u00e3o e transla\u00e7\u00e3o.",
        "definition": "Envolve entender como a Terra gira em torno de seu pr\u00f3prio eixo (rota\u00e7\u00e3o) e ao redor do Sol (transla\u00e7\u00e3o) para compreender as consequ\u00eancias que afetam a vida no planeta: a sucess\u00e3o de dias e noites, a dura\u00e7\u00e3o do ano, as esta\u00e7\u00f5es do ano (primavera, ver\u00e3o, outono, inverno), os solst\u00edcios e equin\u00f3cios, e at\u00e9 a organiza\u00e7\u00e3o dos fusos hor\u00e1rios, al\u00e9m de fen\u00f4menos como a For\u00e7a de Coriolis, que influencia ventos e correntes mar\u00edtimas.",
        "language": "pt_BR",
        "term_data": null,
        "id_niche": 1
    },
    {
        "term": "Portugu\u00eas e Matem\u00e1tica",
        "definition": "S\u00e9ries Inciais do Ensino Fundamenal - Avalia\u00e7\u00e3o de escolaridade.",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 1
    },
    {
        "term": "RATEIO",
        "definition": "Termo Gen\u00e9rico (raiz ou inicial) deste nicho",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 3
    },
    {
        "term": "UFCSPA-5",
        "definition": "Primeiro termo espec\u00edfico deste nicho",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 3
    },
    {
        "term": "RATEIO",
        "definition": "Termo Gen\u00e9rico (raiz ou inicial) deste nicho",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 4
    },
    {
        "term": "DIPP-5",
        "definition": "Primeiro termo espec\u00edfico deste nicho",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 4
    },
    {
        "term": "NEAD",
        "definition": "Termo Gen\u00e9rico (raiz ou inicial) deste nicho",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 2
    },
    {
        "term": "NEEJACP-PF",
        "definition": "Termo espec\u00edfico inicial do Habitat NEAD",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 2
    },
    {
        "term": "N\u00edvel de Ensino - PF",
        "definition": "Exame para Certifica\u00e7\u00e3o de Compet\u00eancias de Jovens e Adultos.\r\nAtividades, cursos, certifica\u00e7\u00f5es, etc, realizadas na Institui\u00e7\u00e3o.",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 2
    },
    {
        "term": "NEAD",
        "definition": null,
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 1
    },
    {
        "term": "Ensino M\u00e9dio SUPERIOR",
        "definition": "Nivel inexistente",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 1
    },
    {
        "term": "bbbbbbbbbbbbb",
        "definition": "so bbbbbbbbbbbbb",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 1
    },
    {
        "term": "cccccc",
        "definition": "teste cccc",
        "language": "pt_BR",
        "term_data": "{\"document\": []}",
        "id_niche": 1
    },
    {
        "term": "question_24_00001",
        "definition": "Quest\u00e3o 01 do termo BT 24",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"questions\":[{\"question_type\":\"Resposta_Unica\",\"statement\":\"<p>O QUE \\u00c9 MAT\\u00c9RIA? A mat\\u00e9ria \\u00e9 tudo aquilo que possui massa e volume, ou seja, praticamente tudo que est\\u00e1 \\u00e0 nossa volta. Ela pode ser classificada como corpo e como objeto. A \\u00e1gua que voc\\u00ea bebe \\u00e9 mat\\u00e9ria. Assim como o copo, voc\\u00ea, o ar que respira, entre tantas outras coisas. Voc\\u00ea sabe o que \\u00e9 mat\\u00e9ria? A mat\\u00e9ria \\u00e9 tudo aquilo que possui massa e volume, ou seja, praticamente tudo que est\\u00e1 \\u00e0 nossa volta. A massa nos d\\u00e1 o quanto de mat\\u00e9ria est\\u00e1 presente, enquanto o volume nos d\\u00e1 uma leitura do espa\\u00e7o ocupado pela mat\\u00e9ria. A mat\\u00e9ria \\u00e9 feita de part\\u00edculas muito pequenas, que n\\u00e3o podem ser vistas, conhecidas como \\u00e1tomos. A mat\\u00e9ria, quando se pega um peda\\u00e7o, \\u00e9 chamada de corpo. Quando esse corpo ganha uma fun\\u00e7\\u00e3o, \\u00e9 chamado de objeto. A mat\\u00e9ria apresenta-se para n\\u00f3s de tr\\u00eas formas: como s\\u00f3lidos, como l\\u00edquidos ou como gases. Al\\u00e9m disso, a mat\\u00e9ria possui propriedades espec\\u00edficas, ou seja, pertencentes a uma mat\\u00e9ria, e gerais, comum a todas as mat\\u00e9rias existentes.<\\\/p><p> <\\\/p><p>Segundo o texto, qual \\u00e9 a diferen\\u00e7a correta entre \\\"<strong>corpo<\\\/strong>\\\" e \\\"<strong>objeto<\\\/strong>\\\"?<\\\/p>\",\"alternative_1\":\"Corpo \\u00e9 qualquer por\\u00e7\\u00e3o de mat\\u00e9ria; objeto \\u00e9 um corpo que recebe uma fun\\u00e7\\u00e3o.\",\"expl_alt_1\":\"Correta: o texto afirma que, ao pegar-se um peda\\u00e7o de mat\\u00e9ria, chama\\u2011se corpo; quando esse corpo ganha uma fun\\u00e7\\u00e3o, \\u00e9 chamado de objeto.\",\"alternative_2\":\"Corpo \\u00e9 uma forma de mat\\u00e9ria (s\\u00f3lido, l\\u00edquido ou gasoso); objeto \\u00e9 apenas mat\\u00e9ria gasosa.\",\"expl_alt_2\":\"Incorreta: o texto distingue estados da mat\\u00e9ria (s\\u00f3lido, l\\u00edquido, gasoso) de corpo\\\/objeto; n\\u00e3o afirma que objeto seja apenas gasoso.\",\"alternative_3\":\"Corpo \\u00e9 mat\\u00e9ria sem massa; objeto \\u00e9 mat\\u00e9ria com massa.\",\"expl_alt_3\":\"Incorreta: o texto diz que mat\\u00e9ria tem massa e volume; n\\u00e3o existe corpo sem massa nem objeto definido por ter massa distinta.\",\"alternative_4\":\"Corpo \\u00e9 o mesmo que \\u00e1tomo; objeto \\u00e9 o conjunto de \\u00e1tomos.\",\"expl_alt_4\":\"Incorreta: o texto explica que a mat\\u00e9ria \\u00e9 feita de \\u00e1tomos (part\\u00edculas), mas n\\u00e3o equipara corpo a um \\u00fanico \\u00e1tomo; corpo \\u00e9 uma por\\u00e7\\u00e3o de mat\\u00e9ria composta por muitos \\u00e1tomos.\",\"correct_option\":\"A\",\"answers\":3,\"hits\":1}]}",
        "id_niche": 1
    },
    {
        "term": "ufcspa5_54_00001",
        "definition": "Rateio 01 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,24,29,57,61],\"concourseCEFNumber\":\"7021\",\"concourseCEFDate\":\"2026-05-09\",\"totalRateio\":2,\"totalPrize\":2,\"availableBalance_Next\":1.6,\"availableBalance_Final5\":0.2,\"availableBalance_Special\":0.2,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":1,\"value_4_hits\":0.3,\"value_3_hits\":0.2,\"value_2_hits\":0.1,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00002",
        "definition": "Rateio 02 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[30,38,47,50,68],\"concourseCEFNumber\":\"7022\",\"concourseCEFDate\":\"2026-05-11\",\"totalRateio\":2,\"totalPrize\":3.6,\"availableBalance_Next\":2.88,\"availableBalance_Final5\":0.56,\"availableBalance_Special\":0.56,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":1.8,\"value_4_hits\":0.54,\"value_3_hits\":0.36000000000000004,\"value_2_hits\":0.18000000000000002,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00003",
        "definition": "Rateio 03 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[16,35,44,66,78],\"concourseCEFNumber\":\"7023\",\"concourseCEFDate\":\"2026-05-12\",\"totalRateio\":2,\"totalPrize\":4.88,\"availableBalance_Next\":3.904,\"availableBalance_Final5\":1.048,\"availableBalance_Special\":1.048,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":2.44,\"value_4_hits\":0.732,\"value_3_hits\":0.488,\"value_2_hits\":0.244,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00004",
        "definition": "Rateio 04 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[2,38,43,48,74],\"concourseCEFNumber\":\"7024\",\"concourseCEFDate\":\"2026-05-13\",\"totalRateio\":2,\"totalPrize\":5.904,\"availableBalance_Next\":4.7232,\"availableBalance_Final5\":1.6384,\"availableBalance_Special\":1.6384,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2,4],\"value_5_hits\":2.952,\"value_4_hits\":0.8855999999999999,\"value_3_hits\":0.5904,\"value_2_hits\":0.2952,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00005",
        "definition": "Rateio 05 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[14,27,29,50,57],\"concourseCEFNumber\":\"7025\",\"concourseCEFDate\":\"2026-05-14\",\"totalRateio\":2,\"totalPrize\":8.3616,\"availableBalance_Next\":8.361599999999997,\"availableBalance_Final5\":0,\"availableBalance_Special\":1.6384,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":5.853119999999999,\"value_4_hits\":1.2542399999999998,\"value_3_hits\":0.83616,\"value_2_hits\":0.41808,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00006",
        "definition": "Rateio 06 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[19,51,55,57,70],\"concourseCEFNumber\":\"7026\",\"concourseCEFDate\":\"2026-05-15\",\"totalRateio\":2,\"totalPrize\":10.361599999999997,\"availableBalance_Next\":8.289279999999998,\"availableBalance_Final5\":1.0361599999999997,\"availableBalance_Special\":2.6745599999999996,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.180799999999999,\"value_4_hits\":1.5542399999999996,\"value_3_hits\":1.0361599999999997,\"value_2_hits\":0.5180799999999999,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00007",
        "definition": "Rateio 07 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[24,27,34,44,47],\"concourseCEFNumber\":\"7027\",\"concourseCEFDate\":\"2026-05-16\",\"totalRateio\":2,\"totalPrize\":10.289279999999998,\"availableBalance_Next\":8.231423999999999,\"availableBalance_Final5\":2.0650879999999994,\"availableBalance_Special\":3.7034879999999992,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.144639999999999,\"value_4_hits\":1.5433919999999997,\"value_3_hits\":1.0289279999999998,\"value_2_hits\":0.5144639999999999,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00008",
        "definition": "Rateio 08 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,16,41,42,74],\"concourseCEFNumber\":\"7028\",\"concourseCEFDate\":\"2026-05-18\",\"totalRateio\":2,\"totalPrize\":10.231423999999999,\"availableBalance_Next\":8.1851392,\"availableBalance_Final5\":3.0882303999999996,\"availableBalance_Special\":4.7266303999999995,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":5.115711999999999,\"value_4_hits\":1.5347135999999997,\"value_3_hits\":1.0231424,\"value_2_hits\":0.5115712,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00009",
        "definition": "Rateio 09 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[13,14,17,20,59],\"concourseCEFNumber\":\"7029\",\"concourseCEFDate\":\"2026-05-19\",\"totalRateio\":2,\"totalPrize\":10.1851392,\"availableBalance_Next\":8.14811136,\"availableBalance_Final5\":4.10674432,\"availableBalance_Special\":5.74514432,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.0925696,\"value_4_hits\":1.52777088,\"value_3_hits\":1.01851392,\"value_2_hits\":0.50925696,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00010",
        "definition": "Rateio 10 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[16,19,24,50,55],\"concourseCEFNumber\":\"7030\",\"concourseCEFDate\":\"2026-05-20\",\"totalRateio\":2,\"totalPrize\":10.14811136,\"availableBalance_Next\":8.118489087999999,\"availableBalance_Final5\":5.121555455999999,\"availableBalance_Special\":6.759955456,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":5.07405568,\"value_4_hits\":1.5222167039999999,\"value_3_hits\":1.014811136,\"value_2_hits\":0.507405568,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00011",
        "definition": "Rateio 11 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[3,12,40,56,70],\"concourseCEFNumber\":\"7031\",\"concourseCEFDate\":\"2026-05-21\",\"totalRateio\":2,\"totalPrize\":10.118489087999999,\"availableBalance_Next\":7.082942361599999,\"availableBalance_Final5\":6.1334043648,\"availableBalance_Special\":7.7718043648,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[2,4],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":5.059244543999999,\"value_4_hits\":1.5177733631999997,\"value_3_hits\":1.0118489088,\"value_2_hits\":0.5059244544,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00012",
        "definition": "Rateio 12 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[5,28,48,49,71],\"concourseCEFNumber\":\"7032\",\"concourseCEFDate\":\"2026-05-22\",\"totalRateio\":2,\"totalPrize\":9.082942361599999,\"availableBalance_Next\":7.266353889279999,\"availableBalance_Final5\":7.041698600959999,\"availableBalance_Special\":8.680098600960001,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":4.5414711807999995,\"value_4_hits\":1.3624413542399998,\"value_3_hits\":0.9082942361599999,\"value_2_hits\":0.45414711807999997,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00013",
        "definition": "Rateio 13 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[1,29,32,33,56],\"concourseCEFNumber\":\"7033\",\"concourseCEFDate\":\"2026-05-23\",\"totalRateio\":2,\"totalPrize\":9.266353889279998,\"availableBalance_Next\":7.413083111423998,\"availableBalance_Final5\":7.9683339898879995,\"availableBalance_Special\":9.606733989888001,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[4],\"value_5_hits\":4.633176944639999,\"value_4_hits\":1.3899530833919995,\"value_3_hits\":0.9266353889279998,\"value_2_hits\":0.4633176944639999,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00014",
        "definition": "Rateio 14 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[12,21,74,77,79],\"concourseCEFNumber\":\"7034\",\"concourseCEFDate\":\"2026-05-25\",\"totalRateio\":2,\"totalPrize\":9.413083111423997,\"availableBalance_Next\":7.530466489139198,\"availableBalance_Final5\":8.909642301030399,\"availableBalance_Special\":10.548042301030401,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2,4],\"value_5_hits\":4.706541555711999,\"value_4_hits\":1.4119624667135995,\"value_3_hits\":0.9413083111423998,\"value_2_hits\":0.4706541555711999,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00015",
        "definition": "Rateio 15 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[14,15,48,58,73],\"concourseCEFNumber\":\"7035\",\"concourseCEFDate\":\"2026-05-26\",\"totalRateio\":2,\"totalPrize\":18.440108790169596,\"availableBalance_Next\":18.440108790169596,\"availableBalance_Final5\":0,\"availableBalance_Special\":10.548042301030401,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[2],\"value_5_hits\":12.908076153118717,\"value_4_hits\":2.7660163185254394,\"value_3_hits\":1.8440108790169596,\"value_2_hits\":0.9220054395084798,\"value_1_hits\":0}]}",
        "id_niche": 3
    },
    {
        "term": "ufcspa5_54_00016",
        "definition": "Rateio 16 do termo BT 54",
        "language": "pt_BR",
        "term_data": "{\"documents\":[],\"rateios\":[{\"lotteryNumbers\":[15,42,63,66,77],\"concourseCEFNumber\":\"7036\",\"concourseCEFDate\":\"2026-05-27\",\"totalRateio\":2,\"totalPrize\":20.440108790169596,\"availableBalance_Next\":16.352087032135675,\"availableBalance_Final5\":2.0440108790169598,\"availableBalance_Special\":12.592053180047362,\"participants\":[{\"user_id\":2,\"lotteryNumbersUser\":[\"3\",\"12\",\"40\",\"48\",\"50\"],\"contribution\":1},{\"user_id\":4,\"lotteryNumbersUser\":[\"1\",\"2\",\"3\",\"12\",\"40\"],\"contribution\":1}],\"5_hits\":[],\"4_hits\":[],\"3_hits\":[],\"2_hits\":[],\"1_hits\":[],\"value_5_hits\":10.220054395084798,\"value_4_hits\":3.066016318525439,\"value_3_hits\":2.0440108790169598,\"value_2_hits\":1.0220054395084799,\"value_1_hits\":0}]}",
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

