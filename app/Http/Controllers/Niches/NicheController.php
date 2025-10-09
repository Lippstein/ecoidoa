<?php

namespace App\Http\Controllers\Niches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Niche;

class NicheController extends Controller
{
    // /**
    //  * Exibe a lista de niches.
    //  */
    // public function index()
    // {
    //     $niches = Niche::all();
    //     return view('niches.index', compact('niches'));
    // }

    // /**
    //  * Exibe um niche específico.
    //  */
    // public function show($id)
    // {
    //     $niche = Niche::findOrFail($id);
    //     return view('niches.show', compact('niche'));
    // }

    //
    /**
     * Exibe a lista de niches.
     */
    public function listNichesForm()
    {
        $niches = \App\Models\Niche::select('id','niche','niche_data')->get();
        return view('niches.niches_list', compact('niches'));
    }

    //
    /**
     * Criar um novo niche.
     */
    public function addNichesForm()
    {
        $niches = \App\Models\Niche::select('id','niche','niche_data')->get();
        return view('niches.niches_create', compact('niches'));
    }
}
