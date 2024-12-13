<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;

Route::post('/api/participant/create', [ParticipantController::class, 'create']);
Route::post('/api/profile/create', [ProfileController::class, 'create']);

// Use Vue router in resources/js/plugins/router.js
Route::get('{any?}', fn() => view('app'))
    ->where('any', '.*');
