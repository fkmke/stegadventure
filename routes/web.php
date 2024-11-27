<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactFormController;

/*
Route::get('/api' , function() {
   return 'JSON for backend can be put here';
});
*/

Route::post('/api/contactform', [ContactFormController::class, 'submit']);

// Use Vue router in resources/js/plugins/router.js
Route::get('{any?}', fn() => view('app'))
    ->where('any', '.*');
