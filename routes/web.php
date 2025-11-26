<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UsersDataFlexController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Habitats\HabitatController;
use App\Http\Controllers\Niches\NicheController;
use App\Http\Controllers\Terms\TesauroController;
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
    return view('welcome', compact('habitats')); // ou qualquer view que desejar
});

Route::get('/welcome', function () {
    $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
    return view('welcome', compact('habitats')); // ou qualquer view que desejar
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    // Rota de dashboard protegida
    Route::get('/dashboard', function () {
        $userId = Auth::user()->id;
        $usersDataFlexList = \App\Models\UsersDataFlex::where('user_id', $userId)->get();
    return view('dashboard', compact('usersDataFlexList'));
    })->name('dashboard');

    // Formulário de escolha de nicho
    Route::get('/habitats_niches', [UsersDataFlexController::class, 'showHabitatsNichesForm'])->name('habitats_niches.show');
    Route::post('/habitats_niches', [UsersDataFlexController::class, 'saveHabitatsNiches'])->name('habitats_niches.save');

    Route::get('/users/users_list', [UserController::class, 'listUsersForm'])->name('users_list.show');
    Route::get('/users/users_create', [UserController::class, 'addUsersForm'])->name('users_create.show');
    Route::post('/users/users_create', [UserController::class, 'storeUsersForm'])->name('users_create.store');
    Route::get('/users/users_show/{id}', [UserController::class, 'showUsersForm'])->name('users_show.show');
    Route::get('/users/users_edit/{id}', [UserController::class, 'editUsersForm'])->name('users_edit.show');
    Route::put('/users/users_update/{id}', [UserController::class, 'updateUsersForm'])->name('users_update.show');
    Route::delete('/users/users_destroy/{id}', [UserController::class, 'destroyUsersForm'])->name('users_destroy.show');

    Route::get('/habitats/habitats_list', [HabitatController::class, 'listHabitatsForm'])->name('habitats_list.show');
    Route::get('/habitats/habitats_create', [HabitatController::class, 'addHabitatsForm'])->name('habitats_create.show');
    Route::post('/habitats/habitats_create', [HabitatController::class, 'storeHabitatsForm'])->name('habitats_create.store');
    Route::get('/habitats/habitats_show/{id}', [HabitatController::class, 'showHabitatsForm'])->name('habitats_show.show');
    Route::get('/habitats/habitats_edit/{id}', [HabitatController::class, 'editHabitatsForm'])->name('habitats_edit.show');
    Route::put('/habitats/habitats_update/{id}', [HabitatController::class, 'updateHabitatsForm'])->name('habitats_update.show');
    Route::delete('/habitats/habitats_destroy/{id}', [HabitatController::class, 'destroyHabitatsForm'])->name('habitats_destroy.show');

    Route::get('/niches/niches_list', [NicheController::class, 'listNichesForm'])->name('niches_list.show');
    Route::get('/niches/niches_create', [NicheController::class, 'addNichesForm'])->name('niches_create.show');
    Route::post('/niches/niches_create', [NicheController::class, 'storeNichesForm'])->name('niches_create.store');
    Route::get('/niches/niches_show/{id}', [NicheController::class, 'showNichesForm'])->name('niches_show.show');
    Route::get('/niches/niches_edit/{id}', [NicheController::class, 'editNichesForm'])->name('niches_edit.show');
    Route::put('/niches/niches_update/{id}', [NicheController::class, 'updateNichesForm'])->name('niches_update.show');
    Route::delete('/niches/niches_destroy/{id}', [NicheController::class, 'destroyNichesForm'])->name('niches_destroy.show');

    Route::match(['get', 'post'], 'term/tesauro_list', [TesauroController::class, 'listTesauroForm'])->name('tesauro_list.show');
    Route::get('/term/tesauro_filter', [TesauroController::class, 'filterTesauroForm'])->name('tesauro_filter.show');

    Route::get('/term/term_edit/{niche_filter}/{id}', [TesauroController::class, 'editTermForm'])->name('term_edit.show');
    Route::post('/term/term_edit', [TesauroController::class, 'updateTermForm'])->name('term_edit.update');

    Route::get('/term/term_create', [TesauroController::class, 'addTermForm'])->name('term_create.show');
    Route::post('/term/term_create', [TesauroController::class, 'storeTermForm'])->name('term_create.store');
    Route::get('/term/term_creatent', [TesauroController::class, 'addTermNTForm'])->name('term_creatent.show');
    Route::post('/term/term_creatent', [TesauroController::class, 'storeTermNTForm'])->name('term_creatent.store');

});
