<?php

use Illuminate\Support\Facades\Route;
use App\Models\Habitat;



Route::get('/', function () {
    $habitats = \App\Models\Habitat::select('id','habitat','habitat_data')->get();
    return view('welcome', compact('habitats'));
});

Route::get('/welcome-niches', function () {
    $habitats = \App\Models\Habitat::with(['niches'])->get();
    return view('welcome_niches', compact('habitats'));
});
