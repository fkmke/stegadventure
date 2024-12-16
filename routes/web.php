<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\UESController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;

Route::post('/api/participant/create', [ParticipantController::class, 'create']);
Route::post('/api/participant/finish', [ParticipantController::class, 'finish']);
Route::post('/api/profile/create', [ProfileController::class, 'create']);
Route::post('/api/game/node/add', [GameController::class, 'addGameNode']);
Route::post('/api/reading/add', [ReadingController::class, 'addReading']);
Route::post('/api/ues/create', [UESController::class, 'create']);

// Use Vue router in resources/js/plugins/router.js
Route::get('{any?}', fn() => view('app'))
    ->where('any', '.*');
