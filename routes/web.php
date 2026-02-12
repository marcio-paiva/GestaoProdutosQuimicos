<?php

use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\InventoryController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FdsController;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/requests', [ProductRequestController::class, 'index'])->name('requests.index');
    Route::post('/requests', [ProductRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/create', [ProductRequestController::class, 'create'])->name('requests.create');

    Route::patch('/requests/{productRequest}/evaluate', [ProductRequestController::class, 'evaluate'])->name('requests.evaluate');
    Route::get('/requests/{productRequest}/evaluate', [ProductRequestController::class, 'showEvaluateForm'])->name('requests.evaluate.form');

    Route::get('/storages', [StorageController::class, 'index'])->name('storages.index');
    Route::post('/storages', [StorageController::class, 'store'])->name('storages.store');
    Route::get('/storages/create', [StorageController::class, 'create'])->name('storages.create');


    Route::resource('inventory', InventoryController::class);

    Route::get('/fds', [FdsController::class, 'index'])->name('fds.index');
    
    Route::get('/requests/new', function() {
                return view('requests.form');
            })->name('requests.form')->middleware('auth');
});

require __DIR__.'/auth.php';