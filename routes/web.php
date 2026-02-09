<?php

use App\Http\Controllers\ProductRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Protege as rotas: só usuários logados acessam
Route::middleware(['auth'])->group(function () {
    
    // Rotas para Solicitações
    Route::get('/requests', [ProductRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');
    
    // Rota para Avaliador (poderia ter um middleware de proteção extra aqui)
    Route::patch('/requests/{productRequest}/evaluate', [ProductRequestController::class, 'evaluate'])->name('requests.evaluate');
});