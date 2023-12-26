<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\SorteioController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/sorteio', [SorteioController::class, 'indexLaravel'])->name('index');
Route::post('/sorteio/gerador', [SorteioController::class, 'geradorLaravel'])->name('gerador');

