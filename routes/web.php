<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


use App\Http\Controllers\AuthController;
use App\Models\Habitat;


// Formulário de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Formulário de registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Formulário de "esqueceu a senha"
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Formulário para redefinir a senha (link enviado por email)
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::get('/', function () {
    $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
    return view('index', compact('habitats')); // ou qualquer view que desejar
});


Route::middleware(['auth', 'verified'])->group(function () {
    // ...
    // Route::post('niches', [NeadController::class, 'showNiches'])->name('show.niches');

    // Route::get('/niches', function () {
    //     $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
    //     return view('niches', compact('habitats'));
    // });

    Route::get('/welcome', function () {
        $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
        return view('welcome', compact('habitats'));
    });


    // Route::get('/niches', [NicheController::class, 'show'])->name('niches.show');

    Route::get('/habitats_niches', function () {
        $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
        return view('habitats_niches', compact('habitats'));
    })->name('habitats_niches.show');

});

// Rota de dashboard protegida (exemplo)
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    $userId = Auth::user()->id;
    $usersDataFlexList = \App\Models\UsersDataFlex::where('user_id', $userId)->get();
    return view('dashboard', compact('usersDataFlexList'));
})->middleware('auth')->name('dashboard');


Route::get('/nead/{id}', [NeadController::class, 'show'])->name('nead.show');
Route::get('/rateio/{id}', [RateioController::class, 'show'])->name('rateio.show');


