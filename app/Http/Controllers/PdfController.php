<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsersDataFlex;
use App\Models\Niche;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function historico($id, $nivelEnsino)
    {
        $userDataFlex = UsersDataFlex::with(['user', 'habitat', 'niche'])->findOrFail($id);
        $userData = User::findOrFail($userDataFlex->user_id);
        $nicheData = Niche::findOrFail($userDataFlex->niche_id);

        $pdf = Pdf::loadView('pdf.historico', [
            'userDataFlex' => $userDataFlex,
            'userData' => $userData,
            'nicheData' => $nicheData,
            'nivelEnsino' => $nivelEnsino,
        ]) ->setPaper('a4', 'portrait'); // define A4

        return $pdf->stream('perfil-' . $userDataFlex->id . '.pdf');
        
    }

    public function boletim($id, $nivelEnsino)
    {
        $userDataFlex = UsersDataFlex::with(['user', 'habitat', 'niche'])->findOrFail($id);
        $userData = User::findOrFail($userDataFlex->user_id);
        $nicheData = Niche::findOrFail($userDataFlex->niche_id);

        $pdf = Pdf::loadView('pdf.boletim', [
            'userDataFlex' => $userDataFlex,
            'userData' => $userData,
            'nicheData' => $nicheData,
            'nivelEnsino' => $nivelEnsino,
        ]) ->setPaper('a4', 'landscape'); // define A4

        return $pdf->stream('perfil-' . $userDataFlex->id . '.pdf');
        
    }
}

