<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PainelController;
use App\Http\Controllers\VeiculoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::name('painel.')->middleware('auth')->prefix('painel')->group(function () {
    Route::get('/', [PainelController::class, 'index'])->name('index');
    Route::get('/sair', [PainelController::class, 'sair'])->name('sair');

    Route::post('/usuarios/destroy-permanente/{id}', [UserController::class, 'destroy_permanente'])->name('usuarios.destroy_permanente');
    Route::get('/usuarios/restaurar/{id}', [UserController::class, 'restaurar'])->name('usuarios.restaurar');
    Route::get('/usuarios/desativados', [UserController::class, 'desativados'])->name('usuarios.desativados');

    Route::get('/perfil', [UserController::class, 'perfil'])->name('usuarios.perfil');
    Route::post('/perfil/salvar-erfil', [UserController::class, 'salvarPerfil'])->name('usuarios.salvarPerfil');
    Route::resource('/usuarios', UserController::class);

    Route::resource('/veiculos', VeiculoController::class);
});

require __DIR__.'/auth.php';
