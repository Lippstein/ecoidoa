<?php
namespace App\Http\Controllers\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // Listar todos os campos da tabela relations
    $relations = \App\Models\Relation::orderBy('term_order')->get()->toArray();
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
        return view('tesauro.term_create', compact('niche_filter', 'bt_filter', 'id_term_bt', 'name_term_bt', 'term_order'));
    }

     /**
     * Salva um novo termo no Tesauro.
     */
    public function storeTermForm(Request $request)
    {
        $validated = $request->validate([
                    'term' => 'required|string|max:255|unique:terms,term',
              'definition' => 'nullable|string',
                'language' => 'nullable|string|max:10',
        ]);

        $term = \App\Models\Term::create($validated);
        // termo recem criado
        $id_term_nt = $term->id;
        $id_term_bt = $request->input('id_term_bt');
        $nicheId = $request->input('niche_filter');
        $userId = Auth::id();
        $term_order = $request->input('term_order');
        $niche_filter = $request->input('niche_filter'); 
        $bt_filter = $request->input('bt_filter'); 

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
        $terms = \App\Models\Term::orderBy('term')->get();
        return view('tesauro.term_creatent', compact('niche_filter', 'bt_filter', 'id_term_bt', 'name_term_bt', 'term_order', 'terms'));
    }

     /**
     * Salva um novo termo no Tesauro.
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

