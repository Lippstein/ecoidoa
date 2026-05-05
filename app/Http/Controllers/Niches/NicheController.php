<?php

namespace App\Http\Controllers\Niches;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habitat;
use App\Models\Niche;
use Exception;

class NicheController extends Controller
{
    //
    /**
     * Exibe a lista de niches.
     */
    public function listNichesForm()
    {
        $niches = \App\Models\Niche::with(['habitat'])
        ->select('id', 'niche', 'niche_data', 'created_at', 'habitat_id')
        ->paginate(10);
        return view('niches.niches_list', compact('niches'));
    }

    /**
     * Visualizar um niche.
     */
    public function showNichesForm($id)
    {
        $niche = Niche::findOrFail($id);
        return view('niches.niches_show', compact('niche'));
    }

    /**
     * Editar um niche.
     */
    public function editNichesForm($id)
    {
        $niche = Niche::findOrFail($id);
        // dd($niche);
        return view('niches.niches_edit', compact('niche'));
    }

    /**
     * Atualizar um niche.
     */
    public function updateNichesForm(Request $request, $id)
    {
        $niche = Niche::findOrFail($id);
        $validated = $request->validate([
            'niche'      => 'required|string|max:100',
            'description'=> 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'trade_name' => 'required|string|max:100',
            'foundation' => 'nullable|string|max:100',
            'authorization1' => 'nullable|string|max:100',
            'authorization2' => 'nullable|string|max:100',
            'cnpj' => 'nullable|string|max:100',
            'address' => 'required|array|min:1',
            'address.*' => 'nullable|string|max:255',
            'rules' => 'required|array|min:1',
            'rules.*' => 'nullable|string|max:512',
        ]);
        // Preparar os dados para armazenar em niche_data
        $data = [];
        $data = $request->only(['niche', 'description', 'company_name', 'trade_name', 'foundation', 'authorization1', 'authorization2', 'cnpj', 'address', 'rules']);
        // dd($data);
        $niche->niche_data = $data;

        // $niche->update($validated);
        $niche->update($request->all());
        return redirect()->route('niches_list.show')->with('status', $niche->niche . ' atualizado com sucesso!');
    }

    /**
     * Criar um novo niche.
     */
    public function addNichesForm()
    {
        $niches = \App\Models\Niche::select('id','niche','niche_data')->get();
        $habitats = Habitat::all();
        return view('niches.niches_create', compact('habitats', 'niches'));
    }


    /**
     * Armazenar um novo rateio.
     */
    public function storeNichesForm(Request $request)
    {
        $validated = $request->validate([
            'habitat_id'   => 'required|exists:habitats,id',
            'niche'        => 'required|string|max:100|unique:niches',
            'description'  => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'trade_name'   => 'required|string|max:100',
            'foundation'   => 'nullable|string|max:100',
            'authorization1'=> 'nullable|string|max:100',
            'authorization2'=> 'nullable|string|max:100',
            'cnpj' => 'nullable|string|max:100',
        ]);
        $data = $request->only(['description', 'company_name', 'trade_name', 'foundation', 'authorization1', 'authorization2', 'cnpj']);
        $niche = Niche::create([
            'habitat_id' => $request->habitat_id,
            'niche' => $request->niche,
            'niche_data' => json_encode($data),
        ]);
        return redirect()->route('niches_list.show')->with('success', 'Nicho criado com sucesso!');
    }

    /**
     * Excluir um niche.
     */
    public function destroyNichesForm(Request $request, $id)
    {
        try{
            $niche = Niche::findOrFail($id);
            $niche->delete();
            return redirect()->route('niches_list.show')->with('status', 'Nicho excluído com sucesso.');
        } catch (Exception $e) {
            return redirect()->route('niches_list.show')->with('status', 'Violação de Integridade - Nicho não excluído.');
        }
    }
}
