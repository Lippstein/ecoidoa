<?php
namespace App\Http\Controllers\Terms;
use Carbon\Carbon;
use App\Models\Term; 
use App\Http\Controllers\Controller;
use Carbon\Month;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TesauroController extends Controller
{
    /**
     * Exibe a página principal do Tesauro.
     */
    public function listTesauroForm(Request $request)
    {
        $niche_filter = $request->input('niche_filter'); 
        $bt_filter = $request->input('bt_filter');
        $id_term_bt = $request->input('id_term_bt');
        $term_order = $request->input('term_order');
        // lista de niches para filtrar
        $niches = \App\Models\Niche::all();    
        // lista de termos do tesauro sem filtrar pelo niche nem pelo usuario
        if (empty($niche_filter)) {
            $tesauro = \App\Models\Term::with(['relationsBT','relationsNT'])
                ->paginate(1000);
        } else {
            $tesauro = \App\Models\Term::with(['relationsBT','relationsNT'])
            ->whereHas('relationsNT', function($q) use ($niche_filter) {
            $q->where('id_niche', $niche_filter);
            })
            ->paginate(1000);
        }
        // dd($tesauro);
        // Listar todos os campos da tabela relations
        $relations = \App\Models\Relation::where('id_niche', $niche_filter)
            ->orderBy('term_order')
            ->get()
            ->toArray();
        
        return view('tesauro.tesauro_list', compact('tesauro', 'niches', 'niche_filter', 'bt_filter', 'relations', 'id_term_bt', 'term_order'));
    }

     /**
     * Exibe o formulário para adicionar um novo termo ao Tesauro.
     */
    public function addTermForm()
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $id_term_bt = request()->input('id_term_bt');
        $name_term_bt = request()->input('name_term_bt');
        $term_order = request()->input('term_order');
        // dd($niche_filter, $bt_filter, $id_term_bt, $name_term_bt, $term_order);
        return view('tesauro.term_create', compact('niche_filter', 'bt_filter', 'id_term_bt', 'name_term_bt', 'term_order'));
    }

     /**
     * Salva um novo termo no Tesauro.
     */
    public function storeTermForm(Request $request)
    {
        $nicheId = $request->input('niche_filter');
        $soTermo = $request->input('soTermo');
        $validated = $request->validate([
            'term' => [
                'required',
                'string',
                'max:255',
                    Rule::unique('terms', 'term')->where('id_niche', $nicheId),
            ],
            'definition' => 'nullable|string',
            'language' => 'nullable|string|max:10',
        ]);
        $validated['id_niche'] = $nicheId;

        $term = \App\Models\Term::create($validated);
        // termo recem criado
        $id_term_nt = $term->id;
        $id_term_bt = $request->input('id_term_bt');
        $nicheId = $request->input('niche_filter');
        $userId = Auth::id();
        $term_order = $request->input('term_order');
        $niche_filter = $request->input('niche_filter'); 
        $bt_filter = $request->input('bt_filter'); 

        if($soTermo === 'soTermo') {
            return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Termo cadastrado com sucesso!');
        }
        // Criar a relação BT se id_term_bt for fornecido
        if (!empty($id_term_bt)) {
            if (empty($nicheId)) {
                return back()->withErrors(['niche_filter' => 'Selecione um nicho antes de cadastrar.']);
            }
            // Verifica duplicidade
            $exists = \App\Models\Relation::where('id_term_nt', $id_term_nt)
                ->where('id_term_bt', $id_term_bt)
                ->where('id_niche', $nicheId)
                ->where('id_user', $userId)
                ->exists();
            if ($exists) {
                return back()->withErrors(['relation' => 'Já existe uma relação com estes dados.']);
            }
            \App\Models\Relation::create([
                'id_term_nt' => $id_term_nt,
                'id_term_bt' => $id_term_bt,
                'id_niche' => $nicheId,
                'id_user' => $userId,
                'term_order' => $term_order,
            ]);
        }
        return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Termo cadastrado com sucesso!');
    }

    public function addTermNTForm()
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $id_term_bt = request()->input('id_term_bt');
        $name_term_bt = request()->input('name_term_bt');
        $term_order = request()->input('term_order');
        $terms = \App\Models\Term::where('id_niche', $niche_filter)
            ->whereNotIn('id', \App\Models\Relation::where('id_niche', $niche_filter)->pluck('id_term_nt'))
            ->orderBy('term')
            ->get();
        return view('tesauro.term_creatent', compact('niche_filter', 'bt_filter', 'id_term_bt', 'name_term_bt', 'term_order', 'terms'));
    }



    /**
     * Salva um novo termo e relação no Tesauro.
     */
    public function storeTermNTForm(Request $request)
    {
        $validated = $request->validate([
            'id_term_nt'   => 'required|integer|exists:terms,id',
            'id_term_bt'   => 'nullable|integer|exists:terms,id',
            'niche_filter' => 'nullable|integer|exists:niches,id',
            'term_order'   => 'nullable|integer',
        ]);

        $id_term_nt = $validated['id_term_nt'];
        $id_term_bt = $validated['id_term_bt'] ?? $request->input('id_term_bt');
        $nicheId = $validated['niche_filter'] ?? $request->input('niche_filter');
        $userId = Auth::id();
        $term_order = $validated['term_order'] ?? $request->input('term_order');
        $niche_filter = $nicheId;
        $bt_filter = $request->input('bt_filter');

        // dd($id_term_nt, $id_term_bt, $nicheId, $term_order);

        // Criar a relação BT se id_term_bt for fornecido
        if (!empty($id_term_bt)) {
            if (empty($nicheId)) {
                return back()->withErrors(['niche_filter' => 'Selecione um nicho antes de cadastrar.']);
            }
            // Verifica duplicidade
            $exists = \App\Models\Relation::where('id_term_nt', $id_term_nt)
                ->where('id_term_bt', $id_term_bt)
                ->where('id_niche', $nicheId)
                ->where('id_user', $userId)
                ->exists();
            if ($exists) {
                return back()->withErrors(['relation' => 'Já existe uma relação com estes dados.']);
            }
            \App\Models\Relation::create([
                'id_term_nt' => $id_term_nt,
                'id_term_bt' => $id_term_bt,
                'id_niche' => $nicheId,
                'id_user' => $userId,
                'term_order' => $term_order,
            ]);
        }
        return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Relação (NT) cadastrada com sucesso!');
        // return redirect()->route('term_creatent.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter, 'id_term_bt' => $id_term_bt])->with('success', 'Relação (NT) cadastrada com sucesso!');
    }

    /**
     * Editar um termo.
     */
    public function editTermForm($niche_filter, $bt_filter, $id)
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_edit', compact('term', 'niche_filter', 'bt_filter'));
    }

    /**
     * Atualizar um termo.
     */
    public function updateTermForm(Request $request)
    {
        $id = $request->input('id');
        $niche_filter = $request->input('niche_filter');
        $bt_filter = $request->input('bt_filter');
        $term = $request->input('term');
        $definition = $request->input('definition');
        $language = $request->input('language');
        $termToUpdate = \App\Models\Term::findOrFail($id);
        $validated = $request->validate([
            'term'        => 'required|string|max:255',
            // accept either description or definition depending on your schema
            'description' => 'nullable|string|max:255',
            'definition'  => 'nullable|string',
            'language'    => 'nullable|string|max:10',
        ]);
        // update using only validated data
        $termToUpdate->update($validated);
        return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Termo atualizado com sucesso!');
    }

    /**
     * Editar documentos de um termo (lista de uploads).
     */
    public function editTermDocsForm($niche_filter, $bt_filter, $id)
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_docs', compact('term', 'niche_filter', 'bt_filter'));
    }

    /**
     * Atualizar docs de um termo (upload e exclusão).
     */
    public function updateTermDocsForm(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:terms,id',
            'new_doc' => 'file|mimes:pdf|max:1024' // PDF, máximo 1MB
        ]);

        $term = \App\Models\Term::findOrFail($request->input('id'));
        $termData = $term->term_data ?? [];
        $documents = $termData['documents'] ?? [];
        $niche_filter = $request->input('niche_filter'); // diretório do nicho

        // Adicionando novo documento PDF
        if ($request->hasFile('new_doc')) {
            $file = $request->file('new_doc');
            $filename = $niche_filter . '_' . $term->id . '_' . $file->getClientOriginalName();
            $dir = $niche_filter . '/docs';
            if (!Storage::disk('public')->exists($dir)) {
                // Diretório NÃO existe
                Storage::disk('public')->makeDirectory($dir);
            }
            $storagePath = "public/{$dir}/{$filename}";
    
            $relativePath = "{$dir}/{$filename}";

            // Testa se já existe o arquivo no disco public
            if (Storage::disk('public')->exists($relativePath)) {
                return back()->withErrors([
                    'new_doc' => 'Já existe um arquivo com esse nome para este termo no nicho!'
                ]);
            }

            $file->storeAs($dir, $filename, 'public');
            if (Storage::disk('public')->exists("{$dir}/{$filename}")) {
                logger("O arquivo foi realmente salvo em: {$dir}/{$filename}");
            } else {
                logger("Falha ao salvar em: {$dir}/{$filename}");
            }

            $documents[] = $filename;
            $termData['documents'] = $documents;
            $term->term_data = $termData;
            $term->save();
            return back()->with('success', 'Documento PDF incluído com sucesso!');
        }

        // Exclusão
        if ($request->has('action') && str_starts_with($request->input('action'), 'Excluir_')) {
            $doc = substr($request->input('action'), strlen('Excluir_'));
            $documents = array_filter($documents, fn($d) => $d !== $doc);
            $termData['documents'] = array_values($documents);
            $term->term_data = $termData;
            $term->save();
            $dir = $niche_filter . '/docs';
            Storage::disk('public')->delete("{$dir}/{$doc}");
            return back()->with('status', 'Documento excluído com sucesso!');
        }

        return back();
    }

    /**
     * Criar questões de um termo (lista de questões).
     */
    public function createTermQuestionsForm($niche_filter, $bt_filter, $id, $term_order)
    {
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_questions', compact('term', 'niche_filter', 'bt_filter', 'term_order'));
    }

    /**
     * Editar questões de um termo (lista de questões).
     */
    public function editTermQuestionsForm($niche_filter, $bt_filter, $id)
    {
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_questions_showedit', compact('term', 'niche_filter', 'bt_filter'));
    }




    /**
     * Atualizar questões de um termo.
     */
    public function updateTermQuestionsForm(Request $request)
    {

        $id_term_bt = $request->input('term_id');
        $id_niche = $request->input('niche_filter');
        $bt_filter = $request->input('bt_filter');
  

        $redirectToQuestionForm = fn () => redirect()->route('term_questions.showedit', [
            'niche_filter' => $id_niche,
            'bt_filter' => $bt_filter,
            'id' => $id_term_bt ]);


        $validator = Validator::make($request->all(), [
            'question_type' => ['required','string', 'in:Resposta_Unica,Resposta_Multipla,Afirmacao_Incompleta,Foco_Negativo,Assercao_Razao,Associacao_Correspondencia,Lacuna_Completar,Ordenacao_Seriacao,Interpretacao'],
            'statement' => ['required','string', 'max:2048'],
            'alternative_1' => ['required','string', 'max:512'],
            'expl_alt_1' => ['required','string', 'max:512'],
            'alternative_2' => ['required','string', 'max:512'],
            'expl_alt_2' => ['required','string', 'max:512'],
            'alternative_3' => ['required','string', 'max:512'],
            'expl_alt_3' => ['required','string', 'max:512'],
            'alternative_4' => ['required','string', 'max:512'],
            'expl_alt_4' => ['required','string', 'max:512'],
            'correct_option' => ['required','string', 'max:1'],
            'answers' => ['required','integer', 'min:3'],
            'hits' => ['required','integer', 'min:1'], 
            ]);

        $term = \App\Models\Term::findOrFail($id_term_bt);


        if ($validator->fails()) {
            return $redirectToQuestionForm()
                ->withErrors($validator)
                ->withInput(); 
        }

        $validated = $validator->validated();

        $termDataToUpdate = $term->term_data ?? [];
        $existingQuestions = $termDataToUpdate['questions'] ?? [];

        $questionData = [
            'question_type' => $validated['question_type'] ?? '',
            'statement' => $validated['statement'] ?? '',
            'alternative_1' => $validated['alternative_1'] ?? '',
            'expl_alt_1' => $validated['expl_alt_1'] ?? '',
            'alternative_2' => $validated['alternative_2'] ?? '',
            'expl_alt_2' => $validated['expl_alt_2'] ?? '',
            'alternative_3' => $validated['alternative_3'] ?? '',
            'expl_alt_3' => $validated['expl_alt_3'] ?? '',
            'alternative_4' => $validated['alternative_4'] ?? '',
            'expl_alt_4' => $validated['expl_alt_4'] ?? '',
            'correct_option' => $validated['correct_option'] ?? '',
            'answers' => (int)($validated['answers'] ?? 0),
            'hits' => (int)($validated['hits'] ?? 0),
        ];

        if (is_array($existingQuestions) && array_is_list($existingQuestions)) {
            $existingQuestions[0] = array_merge($existingQuestions[0] ?? [], $questionData);
            $termDataToUpdate['questions'] = $existingQuestions;
        } else {
            $termDataToUpdate['questions'] = [$questionData];
        }

        $term->term_data = $termDataToUpdate;
        $term->save();

        return $redirectToQuestionForm()
                ->with('success', 'Questão atualizada com sucesso!');

    }

    /**
     * Salva um novo termo e relação no Tesauro.
     */
    public function storeTermQuestionForm(Request $request)
    {
        // $term_id vai ser o bt do termo a ser criado;
        $id_term_bt = $request->input('term_id');
        $id_niche = $request->input('niche_filter');
        $bt_filter = $request->input('bt_filter');
        $nextTermName=$request->input('nextTermName'); // nome do próximo termo para redirecionar após salvar
        $term_order = $request->input('term_order');
        $userId = Auth::id();

        $redirectToQuestionForm = fn () => redirect()->route('term_questions.create', [
            'niche_filter' => $id_niche,
            'bt_filter' => $bt_filter,
            'id' => $id_term_bt,
            'term_order' => $term_order,
        ]);

        $validator = Validator::make($request->all(), [
            'nextTermName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('terms', 'term')->where('id_niche', $id_niche),
            ],
            'question_type' => ['required','string', 'in:Resposta_Unica,Resposta_Multipla,Afirmacao_Incompleta,Foco_Negativo,Assercao_Razao,Associacao_Correspondencia,Lacuna_Completar,Ordenacao_Seriacao,Interpretacao'],
            'statement' => ['required','string', 'max:2048'],
            'alternative_1' => ['required','string', 'max:512'],
            'expl_alt_1' => ['required','string', 'max:512'],
            'alternative_2' => ['required','string', 'max:512'],
            'expl_alt_2' => ['required','string', 'max:512'],
            'alternative_3' => ['required','string', 'max:512'],
            'expl_alt_3' => ['required','string', 'max:512'],
            'alternative_4' => ['required','string', 'max:512'],
            'expl_alt_4' => ['required','string', 'max:512'],
            'correct_option' => ['required','string', 'max:1'],
            'answers' => ['required','integer', 'min:3'],
            'hits' => ['required','integer', 'min:1'], 
            ]);

        if ($validator->fails()) {
            return $redirectToQuestionForm()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // O termo da tabela terms vem do nextTermName enviado pelo form.
        $validated['term'] = $validated['nextTermName'];
        $validated['id_niche'] = $id_niche ?? $request->input('niche_filter');
        $validated['definition'] = 'Questão '.substr($nextTermName, -2).' do termo BT '.$id_term_bt;

        $documents = []; // inicia vazio, pois a questão não tem docs];
        $questionData = [
            'question_type' => $validated['question_type'] ?? '',
            'statement' => $validated['statement'] ?? '',
            'alternative_1' => $validated['alternative_1'] ?? '',
            'expl_alt_1' => $validated['expl_alt_1'] ?? '',
            'alternative_2' => $validated['alternative_2'] ?? '',
            'expl_alt_2' => $validated['expl_alt_2'] ?? '',
            'alternative_3' => $validated['alternative_3'] ?? '',
            'expl_alt_3' => $validated['expl_alt_3'] ?? '',
            'alternative_4' => $validated['alternative_4'] ?? '',
            'expl_alt_4' => $validated['expl_alt_4'] ?? '',
            'correct_option' => $validated['correct_option'] ?? '',
            'answers' => (int)($validated['answers'] ?? 0),
            'hits' => (int)($validated['hits'] ?? 0),
        ];

        $term = \App\Models\Term::create($validated);
        $term->term_data = [
            'documents' => $documents,
            'questions' => [$questionData],
        ];
        $term->save();
        // id_term_nt recebe o id do termo recem criado
        $id_term_nt = $term->id;

        // dd($id_term_nt);

        // Criar a relação BT se id_term_bt for fornecido
        if (!empty($id_term_bt)) {
            if (empty($id_niche)) {
                return $redirectToQuestionForm()
                    ->withErrors(['niche_filter' => 'Selecione um nicho antes de cadastrar.'])
                    ->withInput();
            }
            // Verifica duplicidade
            $exists = \App\Models\Relation::where('id_term_nt', $id_term_nt)
                ->where('id_term_bt', $id_term_bt)
                ->where('id_niche', $id_niche)
                ->where('id_user', $userId)
                ->exists();
            if ($exists) {
                return $redirectToQuestionForm()
                    ->withErrors(['relation' => 'Já existe uma relação com estes dados.'])
                    ->withInput();
            }
            \App\Models\Relation::create([
                'id_term_nt' => $id_term_nt,
                'id_term_bt' => $id_term_bt,
                'id_niche' => $id_niche,
                'id_user' => $userId,
                'term_order' => $term_order,
            ]);
        }
        return redirect()->route('tesauro_list.show', ['niche_filter' => $id_niche, 'bt_filter' => $bt_filter])->with('success', 'Relação (NT) cadastrada com sucesso!');
    }


    /**
     * Salva um novo termo e relação no Tesauro.
     */
    public function storeTermRateiosForm(Request $request)
    {
        // $term_id vai ser o bt do termo a ser criado;
        $id_term_bt = $request->input('term_id');
        $id_niche = $request->input('niche_filter');
        $bt_filter = $request->input('bt_filter');
        $nextTermName=$request->input('nextTermName'); // nome do próximo termo para redirecionar após salvar
        $term_order = $request->input('term_order');
        $userId = Auth::id();
        // dd($id_term_bt, $id_niche, $bt_filter, $nextTermName, $term_order);

        $redirectToRateiosForm = fn () => redirect()->route('term_rateios.create', [
            'niche_filter' => $id_niche,
            'bt_filter' => $bt_filter,
            'id' => $id_term_bt,
            'term_order' => $term_order,
        ]);

        $validator = Validator::make($request->all(), [
            'nextTermName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('terms', 'term')->where('id_niche', $id_niche),
            ],
            'lotteryNumbers' => ['required', 'array', 'size:5'],
            'lotteryNumbers.*' => ['required', 'integer', 'between:1,80', 'distinct'],
            'concourseCEFNumber' => ['required','numeric', 'min:7000'],
            'concourseCEFDate' => ['required','string', 'date_format:Y-m-d'],
            'totalRateio' => ['required','numeric', 'min:0'],
            'totalPrize' => ['required','numeric', 'min:0'],
            'availableBalance_Next' => ['required','numeric', 'min:0'],
            'availableBalance_Final5' => ['required','numeric', 'min:0'],
            'availableBalance_Special' => ['required','numeric', 'min:0'],
            ]);

        if ($validator->fails()) {
            return $redirectToRateiosForm()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();
        $validated['lotteryNumbers'] = array_map('intval', $validated['lotteryNumbers']);

        // O termo da tabela terms vem do nextTermName enviado pelo form.
        $validated['term'] = $validated['nextTermName'];
        $validated['id_niche'] = $id_niche ?? $request->input('niche_filter');
        $validated['definition'] = 'Rateio '.substr($nextTermName, -2).' do termo BT '.$id_term_bt;

        $documents = []; // inicia vazio, pois a questão não tem docs];
        $rateioData = [
            'lotteryNumbers' => $validated['lotteryNumbers'] ?? [],
            'concourseCEFNumber' => $validated['concourseCEFNumber'] ?? '',
            'concourseCEFDate' => $validated['concourseCEFDate'] ?? '',
            'totalRateio' => (float) ($validated['totalRateio'] ?? 0),
            'totalPrize' => (float) ($validated['totalPrize'] ?? 0),
            'availableBalance_Next' => (float) ($validated['availableBalance_Next'] ?? 0),
            'availableBalance_Final5' => (float) ($validated['availableBalance_Final5'] ?? 0),
            'availableBalance_Special' => (float) ($validated['availableBalance_Special'] ?? 0),
            'participants' => [], // aqui você pode adicionar uma lógica para incluir os participantes do rateio, se necessário
        ];

        $usersDataFlexList = \App\Models\UsersDataFlex::where('niche_id', $id_niche)->get();
        foreach ($usersDataFlexList as $usersDataFlex) {
            $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
            $maintenance = (float) ($profile['maintenance'] ?? 0);
            // cobrar a manutenção de 5 reais para cada participante do rateio, caso ainda não tenha sido cobrada (maintenance = 0), e só incluir o participante no rateio se ele tiver saldo disponível para pagar a manutenção e a contribuição de 1 real. Se o participante tiver saldo para pagar a manutenção mas não tiver saldo para pagar a contribuição, cobrar apenas a manutenção e não incluir o participante no rateio.
            if ($maintenance == 0.0) {
                $maintenance = 5;
                $totalDebts = (float) ($profile['totalDebts'] ?? 0);
                // $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                $profile['maintenance'] = (float) ($maintenance);
                $profile['totalDebts'] = (float) ($totalDebts + $maintenance);
                $profile['availableBalance'] = (float) ($availableBalance - $maintenance);
                $usersDataFlex->user_profile = $profile;
                $usersDataFlex->save();
            }

            // Lógica para montar a lista de participantes do rateio, caso eles tenham saldo disponível para pagar a contribuição.
            if ($profile['availableBalance'] >= 1){
                $rateioData['participants'][] = [
                    'user_id' => $usersDataFlex->user_id,
                    'lotteryNumbersUser' => $profile['lotteryNumbersUser'] ?? ($profile['lotteryNumbers'] ?? []),
                    'contribution' => 1,
                ];
             }
        }

        $term = \App\Models\Term::create($validated);
        $term->term_data = [
            'documents' => $documents,
            'rateios' => [$rateioData],
        ];
        $term->save();


        // id_term_nt recebe o id do termo recem criado
        $id_term_nt = $term->id;

        // Criar a relação BT se id_term_bt for fornecido
        if (!empty($id_term_bt)) {
            if (empty($id_niche)) {
                return $redirectToRateiosForm()
                    ->withErrors(['niche_filter' => 'Selecione um nicho antes de cadastrar.'])
                    ->withInput();
            }
            // Verifica duplicidade
            $exists = \App\Models\Relation::where('id_term_nt', $id_term_nt)
                ->where('id_term_bt', $id_term_bt)
                ->where('id_niche', $id_niche)
                ->where('id_user', $userId)
                ->exists();
            if ($exists) {
                return $redirectToRateiosForm()
                    ->withErrors(['relation' => 'Já existe uma relação com estes dados.'])
                    ->withInput();
            }
            \App\Models\Relation::create([
                'id_term_nt' => $id_term_nt,
                'id_term_bt' => $id_term_bt,
                'id_niche' => $id_niche,
                'id_user' => $userId,
                'term_order' => $term_order,
            ]);
        }
        // Atualizar o totalRateio, availableBalance_Final5 e availableBalance_Special do term_data do termo criado com o valor total do rateio calculado a partir da soma das contribuições dos participantes do rateio.
        $totalRateioAux = (float) 0;
        foreach ($term->term_data['rateios'][0]['participants'] ?? [] as $participant) {
            $totalRateioAux = (float) ($totalRateioAux + (float) ($participant['contribution'] ?? 0));
        }
        $termData = $term->term_data ?? [];
        $termData['rateios'][0]['totalRateio'] = (float) ($totalRateioAux); // salva o total de todas as contribuições dos participantes.
        $term->term_data = $termData;
        $term->save();

        // verificar os ganhadores e atualizar os vetores de cada faixa com o user_id.
        // Subtrair a contribuição do availableBalance e somar a contribuição no totaldebts de cada participante do rateio.
        $users5hits = [];
        $users4hits = [];
        $users3hits = [];
        $users2hits = [];
        $users1hits = [];
        $numeroSorteados = $term->term_data['rateios'][0]['lotteryNumbers'] ?? [];
        foreach ($term->term_data['rateios'][0]['participants'] ?? [] as $index => $participant) {
            $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $participant['user_id'])->first();            
            if ($usersDataFlex) {
                $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                $lotteryNumbersUser = $participant['lotteryNumbersUser'] ?? ($profile['lotteryNumbers'] ?? []);
                $acertos = count(array_intersect($numeroSorteados, $lotteryNumbersUser));
                if ($acertos == 5) {
                    $users5hits[] = $participant['user_id'];
                } elseif ($acertos == 4) {
                    $users4hits[] = $participant['user_id'];
                } elseif ($acertos == 3) {
                    $users3hits[] = $participant['user_id'];
                } elseif ($acertos == 2) {
                    $users2hits[] = $participant['user_id'];
                } elseif ($acertos == 1) {
                    $users1hits[] = $participant['user_id'];
                }
                $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                $contribution = (float) ($participant['contribution'] ?? 0);
                $profile['availableBalance'] = (float) ($availableBalance - $contribution);
                $profile['totalDebts'] = (float) ((float) ($profile['totalDebts'] ?? 0) + $contribution);
                $usersDataFlex->user_profile = $profile;
                $usersDataFlex->save();
            }
        } 

        // Somar os valores acumulados para saber o valor total do premio desse rateio e dividir o valor do premio pelo número de ganhadores de cada faixa para saber o valor do prêmio individual de cada ganhador, e atualizar o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido, caso ele seja premiado, e atualizar os acumulados.
        // Contar no relations quantos NTs, o BT 45 (UFCSPA-5) possui. 
        // Se for maior que 1 buscar os valores acumulados de cada NT relacionado ao BT 45 e somar para ter o valor total acumulado do BT 45, e dividir o valor total acumulado do BT 45 pelo número de ganhadores de cada faixa para saber o valor do prêmio individual de cada ganhador, e atualizar o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido, caso ele seja premiado, e atualizar os acumulados. Se tiver apenas um NT relacionado ao BT 45, usar os valores acumulados no termo do RATEIO anterior.

        $relationsBt45 = \App\Models\Relation::where('id_term_bt', $id_term_bt)->orderByDesc('id')->limit(2)->get();
        $availableBalanceNextAnteriorBt45 = (float) 0.0;
        $availableBalanceNextAnterior = (float) 0.0;
        $availableBalanceFinal5Anterior = (float) 0.0;
        $availableBalanceSpecialAnterior = (float) 0.0;
        if ($relationsBt45->count() == 1) {
            //Não tem Rateio Anterior, então os valores acumulados do BT 45 são 0.
            $availableBalanceNextAnteriorBt45 = (float) 0.0;
            $availableBalanceFinal5Anterior = (float) 0.0;
            $availableBalanceSpecialAnterior = (float) 0.0;
        } elseif ($relationsBt45->count() > 1) {
            $termRelated = \App\Models\Term::find($relationsBt45->last()->id_term_nt);
            if ($termRelated) {
                $availableBalanceNextAnterior = $termRelated->term_data['rateios'][0]['availableBalance_Next'] ?? 0;
                $availableBalanceFinal5Anterior = $termRelated->term_data['rateios'][0]['availableBalance_Final5'] ?? 0;
                $availableBalanceSpecialAnterior = $termRelated->term_data['rateios'][0]['availableBalance_Special'] ?? 0;
            }
        }
        //volta para o ultimo inserido, que é o mais recente, para pegar os valores acumulados do BT 45, e somar com os valores do rateio atual para atualizar o availableBalance_Final5 e availableBalance_Special do term_data do termo criado.
        $firstRelationBt45 = $relationsBt45->first();
        $termRelated = $firstRelationBt45 ? \App\Models\Term::find($firstRelationBt45->id_term_nt) : null;
        $totalRateioAux = $termData['rateios'][0]['totalRateio'] ?? 0;
        $termData = $term->term_data ?? [];
        $termData['rateios'][0]['5_hits'] = $users5hits; // ganhadores com 5
        $termData['rateios'][0]['4_hits'] = $users4hits; // ganhadores com 4
        $termData['rateios'][0]['3_hits'] = $users3hits; // ganhadores com 3
        $termData['rateios'][0]['2_hits'] = $users2hits; // ganhadores com 2
        $termData['rateios'][0]['1_hits'] = $users1hits; // ganhadores com 1
        // Já coloquei o valor na variavel  $availableBalanceNextAnterior então pode gravar zero zerado 
        $termData['rateios'][0]['availableBalance_Next'] = 0.0; // aqui estou atualizando o availableBalance_Next (é o valor do rateio anterior next - ainda não sei se esse rateio também vai acumular para o próximo)
        // Já coloquei o valor na variavel  $availableBalanceFinal5Anterior então pode gravar zero zerado 
        $termData['rateios'][0]['availableBalance_Final5'] = 0.0; // aqui estou atualizando o availableBalance_Final5 (é o valor do rateio anterior final 5 - ainda não sei se esse rateio também vai acumular para o próximo)
        // Já coloquei o valor na variavel  $availableBalanceSpecialAnterior então pode gravar zero zerado 
        $termData['rateios'][0]['availableBalance_Special'] = 0.0; // aqui estou atualizando o availableBalance_Special (é o valor do rateio anterior - ainda não sei se esse rateio também vai acumular para o próximo)
        $term->term_data = $termData;
        $term->save();

        $concourseNumber = $term->term_data['rateios'][0]['concourseCEFNumber'] ?? 0;
        $isFinal5 = ((int) $concourseNumber % 10) === 5;
        $concourseDate = $term->term_data['rateios'][0]['concourseCEFDate'] ?? '';

        // Ex.: $concourseCEFDate = '2026-06-02'
        $dataConcurso = Carbon::createFromFormat('Y-m-d', $concourseDate)->startOfDay();
        $primeiraDataJunho = Carbon::create($dataConcurso->year, 6, 1)->startOfDay();
        // Se 1º de junho for domingo, usa 2 de junho
        if ($primeiraDataJunho->isSunday()) {
            $primeiraDataJunho->addDay();
        }
        // Se for rateio special, se for rateio com final 5 ou rateio normal ajustar o valor total do prêmio para incluir os valores acumulados.
        $value5hits = 0.0;
        $value4hits = 0.0;
        $value3hits = 0.0;
        $value2hits = 0.0;
        $value1hits = 0.0;
        $valueUser5hits = 0.0;
        $valueUser4hits = 0.0;
        $valueUser3hits = 0.0;
        $valueUser2hits = 0.0;
        $valueUser1hits = 0.0;
        $availableBalanceNextAux = (float) ($termData['rateios'][0]['availableBalance_Next'] ?? 0); // vai ler com valor zero
        $availableBalanceFinal5Aux = (float) ($termData['rateios'][0]['availableBalance_Final5'] ?? 0); // vai ler com valor zero
        $availableBalanceSpecialAux = (float) ($termData['rateios'][0]['availableBalance_Special'] ?? 0); // vai ler com valor zero

        if ($primeiraDataJunho->equalTo($dataConcurso)) {
            //************ calculo do especial */
            $valorTotalPremio = $totalRateioAux + $availableBalanceSpecialAnterior + $availableBalanceNextAnterior;
            $value5hits = $valorTotalPremio * 0.70;
            $value4hits = $valorTotalPremio * 0.15;
            $value3hits = $valorTotalPremio * 0.10;
            $value2hits = $valorTotalPremio * 0.05;
            $value1hits = 0.0;

            $hits5Count = is_array($users5hits) ? count($users5hits) : 0;
            $hits4Count = is_array($users4hits) ? count($users4hits) : 0;
            $hits3Count = is_array($users3hits) ? count($users3hits) : 0;
            $hits2Count = is_array($users2hits) ? count($users2hits) : 0;
            $hits1Count = is_array($users1hits) ? count($users1hits) : 0;  

            if ($hits5Count == 0) {
                // Passar todo o valor para 4 acertos caso não tenha ganhador de 5 acertos.
                $value4hits += $value5hits;
            } else {
                //distribuir o prêmio para cada ganhador de 5 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser5hits = $value5hits / $hits5Count;
                foreach ($users5hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser5hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser5hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits4Count == 0) {
                // Passar todo o valor para 3 acertos caso não tenha ganhador de 4 acertos.
                $value3hits += $value4hits;
            } else {
                //distribuir o prêmio para cada ganhador de 4 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser4hits = $value4hits / $hits4Count;
                foreach ($users4hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser4hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser4hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits3Count == 0) {
                // Passar todo o valor para 2 acertos caso não tenha ganhador de 3 acertos, e passar o valor do rateio especial para o próximo rateio caso não tenha ganhador de 3 acertos, ou seja, acumular o valor do rateio especial para o próximo rateio caso não tenha ganhador de 3 acertos.
                $value2hits += $value3hits;
            } else {
                //distribuir o prêmio para cada ganhador de 3 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                 $valueUser3hits = $value3hits / $hits3Count;
                foreach ($users3hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser3hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser3hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits2Count == 0) {
                // Passar todo o valor para 1 acerto caso não tenha ganhador de 2 acertos.
                $value1hits += $value2hits;
            } else {
                //distribuir o prêmio para cada ganhador de 2 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser2hits = $value2hits / $hits2Count;
                foreach ($users2hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser2hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser2hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits1Count == 0) {
                // NENHUM ACERTADOR Passar o valor do rateio especial para o acumulado do próximo rateio.
                $availableBalanceNextAux = $availableBalanceSpecialAux + $availableBalanceNextAux + $value1hits;
            } else {
                //distribuir o prêmio para cada ganhador de 1 acerto, atualizando o availableBalance e totalcredits de cada participante do rateio com o valor do prêmio recebido.
                $valueUser1hits = $value1hits / $hits1Count;
                foreach ($users1hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser1hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser1hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            //No SPECIAL não acumula nada no próximo final5 e no special
            //Ou seja, o final 5 fica com o que tem e o special fica zerado
            // Se NENHUM ACERTADOR a variável $availableBalanceNextAux já acumulou tudo e grava em availableBalance_Next
            $availableBalanceFinal5Aux = $availableBalanceFinal5Aux + $availableBalanceFinal5Anterior; // aqui estou atualizando o availableBalance_Final5 para ficar com o que tinha
            $availableBalanceSpecialAux = 0.0; // aqui estou zerando o availableBalance_Special (pois todo o acumulado foi distribuido)
            $termData = $term->term_data ?? [];
            $termData['rateios'][0]['value_5_hits'] = (float) ($value5hits); // ganhadores com 5
            $termData['rateios'][0]['value_4_hits'] = (float) ($value4hits); // ganhadores com 4
            $termData['rateios'][0]['value_3_hits'] = (float) ($value3hits); // ganhadores com 3
            $termData['rateios'][0]['value_2_hits'] = (float) ($value2hits); // ganhadores com 2
            $termData['rateios'][0]['value_1_hits'] = (float) ($value1hits); // ganhadores com 1
            $termData['rateios'][0]['totalPrize'] = (float) ($valorTotalPremio); // salva o total de todas as contribuições dos participantes.
            $termData['rateios'][0]['availableBalance_Next'] = (float) ($availableBalanceNextAux); // aqui estou atualizando na base o availableBalance_Next
            $termData['rateios'][0]['availableBalance_Final5'] = (float) ($availableBalanceFinal5Aux); // aqui estou atualizando na base o availableBalance_Final5
            $termData['rateios'][0]['availableBalance_Special'] = (float) ($availableBalanceSpecialAux); // aqui estou atualizando na base o availableBalance_Special
            $term->term_data = $termData;
            $term->save();

            } elseif ($isFinal5) {
            $valorTotalPremio = $totalRateioAux + $availableBalanceFinal5Anterior + $availableBalanceNextAnterior;
            $value5hits = $valorTotalPremio * 0.7;
            $value4hits = $valorTotalPremio * 0.15;
            $value3hits = $valorTotalPremio * 0.1;
            $value2hits = $valorTotalPremio * 0.05;
            $value1hits = 0.0;

            $hits5Count = is_array($users5hits) ? count($users5hits) : 0;
            $hits4Count = is_array($users4hits) ? count($users4hits) : 0;
            $hits3Count = is_array($users3hits) ? count($users3hits) : 0;
            $hits2Count = is_array($users2hits) ? count($users2hits) : 0;
            $hits1Count = is_array($users1hits) ? count($users1hits) : 0;  

            if ($hits5Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value5hits;
            } else {
                //distribuir o prêmio para cada ganhador de 5 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser5hits = $value5hits / $hits5Count;
                foreach ($users5hits as $userId) {  
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser5hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser5hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits4Count == 0) {
                $availableBalanceNextAux =  $availableBalanceNextAux + $value4hits;
            } else {
                //distribuir o prêmio para cada ganhador de 4 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser4hits = $value4hits / $hits4Count;
                foreach ($users4hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser4hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser4hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits3Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value3hits;
            } else {
                //distribuir o prêmio para cada ganhador de 3 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                 $valueUser3hits = $value3hits / $hits3Count;
                foreach ($users3hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser3hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser3hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits2Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value2hits;
            } else {
                //distribuir o prêmio para cada ganhador de 2 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser2hits = $value2hits / $hits2Count;
                foreach ($users2hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser2hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser2hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits1Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value1hits;
            } else {
                //distribuir o prêmio para cada ganhador de 1 acerto, atualizando o availableBalance e totalcredits de cada participante do rateio com o valor do prêmio recebido.
                $valueUser1hits = $value1hits / $hits1Count;
                foreach ($users1hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser1hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser1hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            //No FINAL5 não acumula nada no próximo final5
            //Ou seja, o final 5 fica ZERADO e o SPECIAL fica com o que tem
            // Se NENHUM ACERTADOR a variável $availableBalanceNextAux já acumulou tudo e grava em availableBalance_Next

            $availableBalanceFinal5Aux = 0.0; // aqui estou zerando o availableBalance_Final5 para o próximo rateio
            $availableBalanceSpecialAux = $availableBalanceSpecialAux + $availableBalanceSpecialAnterior; // aqui estou mantendo o valor availableBalance_Special
            $termData = $term->term_data ?? [];
            $termData['rateios'][0]['value_5_hits'] = (float) ($value5hits); // ganhadores com 5
            $termData['rateios'][0]['value_4_hits'] = (float) ($value4hits); // ganhadores com 4
            $termData['rateios'][0]['value_3_hits'] = (float) ($value3hits); // ganhadores com 3
            $termData['rateios'][0]['value_2_hits'] = (float) ($value2hits); // ganhadores com 2
            $termData['rateios'][0]['value_1_hits'] = (float) ($value1hits); // ganhadores com 1
            $termData['rateios'][0]['totalPrize'] = (float) ($valorTotalPremio); // salva o total de todas as contribuições dos participantes.
            $termData['rateios'][0]['availableBalance_Next'] = (float) ($availableBalanceNextAux); // aqui estou atualizando na base o availableBalance_Next
            $termData['rateios'][0]['availableBalance_Final5'] = (float) ($availableBalanceFinal5Aux); // aqui estou atualizando na base o availableBalance_Final5
            $termData['rateios'][0]['availableBalance_Special'] = (float) ($availableBalanceSpecialAux); // aqui estou atualizando na base o availableBalance_Special
            $term->term_data = $termData;
            $term->save();
        } else {
            $valorTotalPremio = $totalRateioAux + $availableBalanceNextAnterior;
            $value5hits = $valorTotalPremio * 0.5;
            $value4hits = $valorTotalPremio * 0.15;
            $value3hits = $valorTotalPremio * 0.1;
            $value2hits = $valorTotalPremio * 0.05;
            $value1hits = 0.0;

            $hits5Count = is_array($users5hits) ? count($users5hits) : 0;
            $hits4Count = is_array($users4hits) ? count($users4hits) : 0;
            $hits3Count = is_array($users3hits) ? count($users3hits) : 0;
            $hits2Count = is_array($users2hits) ? count($users2hits) : 0;
            $hits1Count = is_array($users1hits) ? count($users1hits) : 0;  
            if ($hits5Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value5hits;
            } else {
                //distribuir o prêmio para cada ganhador de 5 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser5hits = $value5hits / $hits5Count;
                foreach ($users5hits as $userId) {  
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser5hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser5hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits4Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value4hits;
            } else {
                //distribuir o prêmio para cada ganhador de 4 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser4hits = $value4hits / $hits4Count;
                foreach ($users4hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser4hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser4hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits3Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value3hits;
            } else {
                //distribuir o prêmio para cada ganhador de 3 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                 $valueUser3hits = $value3hits / $hits3Count;
                foreach ($users3hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser3hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser3hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            if ($hits2Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value2hits;
            } else {
                //distribuir o prêmio para cada ganhador de 2 acertos, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser2hits = $value2hits / $hits2Count;
                foreach ($users2hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                            $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                            $profile['availableBalance'] = (float) ($availableBalance + $valueUser2hits);
                            $profile['totalCredits'] = (float) ($totalCredits + $valueUser2hits);
                            $usersDataFlex->user_profile = $profile;
                            $usersDataFlex->save();
                        }
                }
            }
            if ($hits1Count == 0) {
                $availableBalanceNextAux = $availableBalanceNextAux + $value1hits;
            } else {
                //distribuir o prêmio para cada ganhador de 1 acerto, atualizando o availableBalance e totalcreds de cada participante do rateio com o valor do prêmio recebido.
                $valueUser1hits = $value1hits / $hits1Count;
                foreach ($users1hits as $userId) {
                    $usersDataFlex = \App\Models\UsersDataFlex::where('user_id', $userId)->first();
                    if ($usersDataFlex) {
                        $profile = is_array($usersDataFlex->user_profile) ? $usersDataFlex->user_profile : [];
                        $availableBalance = (float) ($profile['availableBalance'] ?? 0);
                        $totalCredits = (float) ($profile['totalCredits'] ?? 0);
                        $profile['availableBalance'] = (float) ($availableBalance + $valueUser1hits);
                        $profile['totalCredits'] = (float) ($totalCredits + $valueUser1hits);
                        $usersDataFlex->user_profile = $profile;
                        $usersDataFlex->save();
                    }
                }
            }
            $availableBalanceFinal5Aux = $availableBalanceFinal5Aux + $availableBalanceFinal5Anterior + ($valorTotalPremio * 0.1); // aqui estou atualizando o availableBalance_Final5
            $availableBalanceSpecialAux = $availableBalanceSpecialAux + $availableBalanceSpecialAnterior + ($valorTotalPremio * 0.1); // aqui estou atualizando o availableBalance_Special
            $termData = $term->term_data ?? [];
            $termData['rateios'][0]['value_5_hits'] = (float) ($value5hits); // ganhadores com 5
            $termData['rateios'][0]['value_4_hits'] = (float) ($value4hits); // ganhadores com 4
            $termData['rateios'][0]['value_3_hits'] = (float) ($value3hits); // ganhadores com 3
            $termData['rateios'][0]['value_2_hits'] = (float) ($value2hits); // ganhadores com 2
            $termData['rateios'][0]['value_1_hits'] = (float) ($value1hits); // ganhadores com 1
            $termData['rateios'][0]['totalPrize'] = (float) ($valorTotalPremio); // salva o total de todas as contribuições dos participantes.
            $termData['rateios'][0]['availableBalance_Next'] = (float) ($availableBalanceNextAux); // aqui estou atualizando na base o availableBalance_Next
            $termData['rateios'][0]['availableBalance_Final5'] = (float) ($availableBalanceFinal5Aux); // aqui estou atualizando na base o availableBalance_Final5
            $termData['rateios'][0]['availableBalance_Special'] = (float) ($availableBalanceSpecialAux); // aqui estou atualizando na base o availableBalance_Special
            $term->term_data = $termData;
            $term->save();
        }
        return redirect()->route('tesauro_list.show', ['niche_filter' => $id_niche, 'bt_filter' => $bt_filter])->with('success', 'PREMIO APURADO! e Relação (NT) cadastrada com sucesso!');
    }


    /**
     * Criar rateios de um termo.
     */
    public function createTermRateiosForm($niche_filter, $bt_filter, $id, $term_order)
    {
        // $niche_filter = request()->input('niche_filter');
        // $bt_filter = request()->input('bt_filter');
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_rateios', compact('term', 'niche_filter', 'bt_filter', 'term_order'));
    }

    

    /**
     * Exibe o formulário para deletar uma relação.
     */
    public function deleteRelationForm()
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $id_term_bt = request()->input('id_term_bt');
        $name_term_bt = request()->input('name_term_bt');
        $id_term_nt = request()->input('id_term_nt');
        $name_term_nt = request()->input('name_term_nt');
        return view('tesauro.relation_delete', compact('niche_filter', 'id_term_bt', 'name_term_bt', 'id_term_nt', 'name_term_nt', 'bt_filter'));
    }

    /**
     * Deleta uma relação.
     */
    public function destroyRelationForm(Request $request)
    {   
        $id_term_bt = $request->input('id_term_bt');
        $id_term_nt = $request->input('id_term_nt');
        $nicheId = $request->input('niche_filter');
        $bt_filter = $request->input('bt_filter');
        $userId = Auth::id();
        $niche_filter = $nicheId;
        // Verifica se o termo específico é também um termo genérico em outra relação
        $isNtAlsoBt = \App\Models\Relation::where('id_term_bt', $id_term_nt)->exists();
        if ($isNtAlsoBt) {
            return back()->withErrors(['relation' => 'O termo específico já está como termo genérico em alguma relação.']);
        }       
        // Deletar a relação
        \App\Models\Relation::where('id_term_bt', $id_term_bt)
            ->where('id_term_nt', $id_term_nt)
            ->where('id_niche', $nicheId)
            ->where('id_user', $userId)
            ->delete();

        return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Relação deletada com sucesso!');
    }

    public function showChildren($id_term_bt, $id_niche)
    {
        // Busca as relações já ordenadas e carrega o termo filho junto.
        $filhos = \App\Models\Relation::with('term')
            ->where('id_term_bt', $id_term_bt)
        ->where('id_niche', $id_niche)
        ->orderBy('term_order')
        ->get();

        return view('tesauro.children_order', compact('filhos', 'id_term_bt', 'id_niche'));
    }

    public function swapOrder(Request $request)
    {
        $idA = $request->input('idA');
        $idB = $request->input('idB');
        $orderA = $request->input('orderA');
        $orderB = $request->input('orderB');
        $id_term_bt = $request->input('id_term_bt');
        $bt_filter = $request->input('bt_filter');
        $id_niche = $request->input('id_niche');

        // Atualiza A para orderB
        \App\Models\Relation::where('id_term_nt', $idA)
            ->where('id_term_bt', $id_term_bt)
            ->where('id_niche', $id_niche)
            ->update(['term_order' => $orderB]);

        // Atualiza B para orderA
        \App\Models\Relation::where('id_term_nt', $idB)
            ->where('id_term_bt', $id_term_bt)
            ->where('id_niche', $id_niche)
            ->update(['term_order' => $orderA]);

        return response()->json(['success' => true]);        
    }
}

