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

Route::prefix('chatbot')->group(function() {
    Route::get('/', [ChatbotController::class, 'index'])->name('chatbot.index');
    Route::get('/create', [ChatbotController::class, 'create'])->name('chatbot.create');
    Route::post('/', [ChatbotController::class, 'store'])->name('chatbot.store');
    Route::get('/{id}', [ChatbotController::class, 'show'])->name('chatbot.show');
    Route::get('/{id}/edit', [ChatbotController::class, 'edit'])->name('chatbot.edit');
    Route::put('/{id}', [ChatbotController::class, 'update'])->name('chatbot.update');
    Route::delete('/{id}', [ChatbotController::class, 'destroy'])->name('chatbot.destroy');
    
    // Chatbot conversation endpoint
    Route::post('/conversation', [ChatbotController::class, 'conversation'])->name('chatbot.conversation');
    
    // Tawk.to configuration endpoint
    Route::get('/tawkto-config', [ChatbotController::class, 'getTawkToConfig'])->name('chatbot.tawkto-config');
});
