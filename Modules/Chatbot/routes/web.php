<?php

use Illuminate\Support\Facades\Route;
use Modules\Chatbot\Http\Controllers\ChatbotController;
use Modules\Chatbot\Http\Controllers\FaqController;
use Modules\Chatbot\Http\Controllers\BotManController;
use Modules\Chatbot\Http\Controllers\MedicalListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are now namespaced correctly by the Module's RouteServiceProvider.
|
*/

Route::group([], function () {
    Route::resource('chatbot', ChatbotController::class)->names('chatbot');
    Route::resource('faqs', FaqController::class);
});

Route::prefix('admin')->group(function() {
    Route::resource('faqs', FaqController::class);
    Route::resource('medical-lists', MedicalListController::class);
});

// API Routes
Route::prefix('api')->group(function() {
    Route::get('/medical-types', [FaqController::class, 'getMedicalTypes']);
    Route::post('/medical-by-type-location', [FaqController::class, 'getMedicalByTypeAndLocation']);
});

Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
