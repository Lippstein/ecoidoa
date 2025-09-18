<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\UsersDataFlex;

class DashboardController extends Controller
{
    /**
     * Exibe o dashboard do usuário autenticado.
     */
    public function dashboard()
    {
        $userId = auth()->id();

        $usersDataFlexList = UsersDataFlex::with(['user', 'habitat', 'niche'])
            ->where('user_id', $userId)
            ->get();

        return view('dashboard', compact('usersDataFlexList'));
    }
}
