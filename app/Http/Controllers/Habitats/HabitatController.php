<?php

namespace App\Http\Controllers\Habitats;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habitat;

class HabitatController extends Controller
{
    // /**
    //  * Exibe a lista de habitats.
    //  */
    // public function index()
    // {
    //     $habitats = Habitat::all();
    //     return view('habitats.index', compact('habitats'));
    // }

    /**
     * Exibe um habitat específico.
     */
    // public function show($id)
    // {
    //     $habitat = Habitat::findOrFail($id);
    //     return view('habitats.show', compact('habitat'));
    // }


    //
    /**
     * Listar habitats.
     */
    public function listHabitatsForm()
    {
        $habitats = Habitat::orderBy('habitat')->select('id','habitat','habitat_data','created_at')->paginate(10);
        return view('habitats.habitats_list', compact('habitats'));
    }

        /**
     * Visualizar um habitat.
     */
    public function showHabitatsForm($id)
    {
        $habitat = Habitat::findOrFail($id);
        return view('habitats.habitats_show', compact('habitat'));
    }

    /**
     * Editar um habitat.
     */
    public function editHabitatsForm($id)
    {
        $habitat = Habitat::findOrFail($id);
        return view('habitats.habitats_edit', compact('habitat'));
    }

    /**
     * Atualizar um habitat.
     */
    public function updateHabitatsForm(Request $request, $id)
    {
        $habitat = Habitat::findOrFail($id);
        $validated = $request->validate([
            'habitat'      => 'required|string|max:255',
            'description'  => 'required|string|max:255',
            'habitat_url'  => 'required|url|max:255',
            'habitat_owner'=> 'required|string|max:255',
            'email_owner'  => 'required|string|email|max:255',
        ]);

        $data = $request->only(['habitat', 'description', 'habitat_url', 'habitat_owner', 'email_owner']);
        $habitat->habitat_data = json_encode($data);

        // $habitat->update($validated);
        $habitat->update($request->all());
        return redirect()->route('habitats_list.show')->with('success', 'Habitat atualizado com sucesso!');
    }


    /**
     * Formulário para criar um novo habitat.
     */
    public function addHabitatsForm()
    {
        return view('habitats.habitats_create');
    }

    /**
     * Armazenar um novo habitat.
     */
    public function storeHabitatsForm(Request $request)
    {
        $validated = $request->validate([
            'habitat'      => 'required|string|max:50|unique:habitats',
            'description'  => 'required|string|max:255',
            'habitat_url'  => 'required|url|max:255',
            'habitat_owner'=> 'required|string|max:255',
            'email_owner'  => 'required|string|email|max:255',
        ]);
        $data = $request->only(['description', 'habitat_url', 'habitat_owner', 'email_owner']);
        //$data['habitat_data'] = json_encode($data);
        // Criação do habitat
        $habitat = Habitat::create([
            'habitat' => $request->habitat,
            'habitat_data' => json_encode($data),
        ]);
        return redirect()->route('habitats_list.show')->with('success', 'Habitat criado com sucesso!');
    }
}
