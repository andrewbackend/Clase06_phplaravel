<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\TaskCrotroller;

Route::get('/', [TaskCrotroller::class, 'index']) -> name('tasks.index');
Route::get('/create', [TaskCrotroller::class, 'create']) -> name('tasks.create');
Route::get('/store', [TaskCrotroller::class, 'store']) -> name('tasks.store');
Route::get('/edit/{id}', [TaskCrotroller::class, 'edit']) -> name('tasks.edit');
Route::post('/update/{id}', [TaskCrotroller::class, 'update']) -> name('tasks.update');
Route::post('/delete/{id}', [TaskCrotroller::class, 'destroy']) -> name('tasks.destroy');