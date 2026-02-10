<?php

use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\InventoryController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('requests.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // rotas de Produtos Químicos
    Route::get('/requests', [ProductRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');
    Route::patch('/requests/{productRequest}/evaluate', [ProductRequestController::class, 'evaluate'])->name('requests.evaluate');
    Route::get('/requests/{productRequest}/evaluate', [ProductRequestController::class, 'showEvaluateForm'])->name('requests.evaluate.form');
    Route::get('/storages', [StorageController::class, 'index'])->name('storages.index');
    Route::post('/storages', [StorageController::class, 'store'])->name('storages.store');
    Route::resource('inventory', InventoryController::class);

    // Rotas de Perfil (Criadas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';