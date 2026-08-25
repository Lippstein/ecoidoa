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
        $user = Auth::user();
        if (!$user) {
            // Redirect to login if not authenticated
            return redirect()->route('login');
        }
        $userId = $user->id;

        $usersDataFlexList = UsersDataFlex::with(['user', 'habitat', 'niche'])
            ->where('user_id', $userId)
            ->orderBy('niche_id', 'asc')
            ->get()
            ->keyBy('niche_id');
        return view('dashboard', compact('usersDataFlexList'));
    }    
}


