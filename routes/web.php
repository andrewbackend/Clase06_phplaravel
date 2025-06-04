<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::post('/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
Route::post('/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
//Agregar nuevas rutas
