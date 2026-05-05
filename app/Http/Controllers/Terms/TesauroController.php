<?php
namespace App\Http\Controllers\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
     * Editar questões de um termo (lista de questões).
     */
    public function editTermQuestionsForm($niche_filter, $bt_filter, $id)
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_questions', compact('term', 'niche_filter', 'bt_filter'));
    }

    /**
     * Atualizar questões de um termo.
     */
    public function updateTermQuestionsForm(Request $request)
    {
        // $request->validate([
        //     'question_type' => 'string|in:multiple_choice,open_ended',
        //     'statement' => 'string',
        //     'alternative_1' => 'string',
        //     'expl_alt_1' => 'string',
        //     'alternative_2' => 'string',
        //     'expl_alt_2' => 'string',
        //     'alternative_3' => 'string',
        //     'expl_alt_3' => 'string',
        //     'alternative_4' => 'string',
        //     'expl_alt_4' => 'string',
        //     'correct_option' => 'string',
        //     // 'language' => 'string|in:pt_BR,en_US',
        //     // 'date' => 'date',
        //     'answers' => 'integer',
        //     'hits' => 'integer',
        //     'userId' => 'integer',
        // ]);

        // $termId = $request->input('term_id');
        // $term = \App\Models\Term::findOrFail($termId);
        // $niche_filter = $request->input('niche_filter');
        // $bt_filter = $request->input('bt_filter');
        // $nextTerm = $request->input('nextTerm'); // nome do próximo termo para redirecionar após salvar

        // $termDataToUpdate = $term->term_data ?? [];
        // // $documents = $termDataToUpdate['documents'] ?? [];

        // $termDataToUpdate['question_type'] = $request->input('question_type');
        // $termDataToUpdate['statement'] = $request->input('statement');
        // $termDataToUpdate['alternative_1'] = $request->input('alternative_1');
        // $termDataToUpdate['expl_alt_1'] = $request->input('expl_alt_1');
        // $termDataToUpdate['alternative_2'] = $request->input('alternative_2');
        // $termDataToUpdate['expl_alt_2'] = $request->input('expl_alt_2');
        // $termDataToUpdate['alternative_3'] = $request->input('alternative_3');
        // $termDataToUpdate['expl_alt_3'] = $request->input('expl_alt_3');
        // $termDataToUpdate['alternative_4'] = $request->input('alternative_4');
        // $termDataToUpdate['expl_alt_4'] = $request->input('expl_alt_4');
        // $termDataToUpdate['correct_option'] = $request->input('correct_option');
        // $term->term_data = $termDataToUpdate;

        // // update using only validated data
        // $termDataToUpdate->update($validated);
        // return redirect()->route('tesauro_list.show', ['niche_filter' => $niche_filter, 'bt_filter' => $bt_filter])->with('success', 'Termo atualizado com sucesso!');




        // $term->save();

        // return back();
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

        $validated = $request->validate([
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
                return back()->withErrors(['niche_filter' => 'Selecione um nicho antes de cadastrar.']);
            }
            // Verifica duplicidade
            $exists = \App\Models\Relation::where('id_term_nt', $id_term_nt)
                ->where('id_term_bt', $id_term_bt)
                ->where('id_niche', $id_niche)
                ->where('id_user', $userId)
                ->exists();
            if ($exists) {
                return back()->withErrors(['relation' => 'Já existe uma relação com estes dados.']);
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
     * Editar rateios de um termo.
     */
    public function editTermRateiosForm($niche_filter, $bt_filter, $id)
    {
        $niche_filter = request()->input('niche_filter');
        $bt_filter = request()->input('bt_filter');
        $term = \App\Models\Term::findOrFail($id);
        return view('tesauro.term_rateios', compact('term', 'niche_filter', 'bt_filter'));
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

