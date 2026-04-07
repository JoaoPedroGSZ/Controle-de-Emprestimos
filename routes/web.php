<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ItemsController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/cadastro', [CadastroController::class, 'create'])->name('cadastro');
Route::post('/cadastro', [CadastroController::class, 'store']);

    Route::post('items/{item}', [ItemsController::class, 'update'])->name('items.update');
    Route::get('/items', [ItemsController::class, 'index'])->name('items.index');
    Route::get('/items/create', [ItemsController::class, 'create'])->name('items.create');
    Route::post('/items', [ItemsController::class, 'store'])->name('items.store');
    Route::get('/items/{item}/edit', [ItemsController::class, 'edit'])->name('items.edit');
     Route::delete('/items/{item}', [ItemsController::class, 'destroy'])->name('items.destroy');