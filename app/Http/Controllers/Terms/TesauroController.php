<?php
namespace App\Http\Controllers\Terms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesauroController extends Controller
{
    /**
     * Exibe a página principal do Tesauro.
     */
    public function listTesauroForm()
    {
        // lista de niches para filtrar
        $niches = \App\Models\Niche::all();    
        // lista de termos do tesauro sem filtrar pelo niche nem pelo usuario
        $tesauro = \App\Models\Term::with(['relationsBT','relationsNT'])->paginate(10);
        //dd($tesauro);
        return view('tesauro.tesauro_list', compact('tesauro', 'niches'));
    }

     /**
     * Exibe o formulário para adicionar um novo termo ao Tesauro.
     */
    public function addTermForm()
    {
        return view('tesauro.term_create');
    }

     /**
     * Salva um novo termo no Tesauro.
     */
    public function storeTermForm(Request $request)
    {
        $validated = $request->validate([
            'term' => 'required|string|max:255',
            'definition' => 'nullable|string',
            'language' => 'nullable|string|max:10',
        ]);

        \App\Models\Term::create($validated);

        return redirect()->route('tesauro_list.show')->with('success', 'Termo cadastrado com sucesso!');
    }

}

