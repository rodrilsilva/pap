<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DefinicoesController;
use App\Http\Controllers\EquipaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\NotificacoesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;


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

Route::get('/', function () {
    return view('welcome');
});

/******************** Rota Dashboard ********************/
Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


/******************** Rotas Agenda ********************/
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

/******************** Rotas Clientes ********************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    /******************** sep ********************/
    Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/show', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/cliente/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/cliente/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

/******************** Rotas Definições ********************/
Route::get('/definicoes', [DefinicoesController::class, 'update'])->name('definicoes.update');
Route::post('/definicoes', [DefinicoesController::class, 'save'])->name('definicoes.save');

/************* Rotas Servicos *************/
Route::get('/definicoes/servicos', [ServicosController::class, 'index'])->name('servicos.index');
Route::get('/definicoes/servicos/update', [ServicosController::class, 'update'])->name('servicos.update');
Route::get('/definicoes/servicos/create', [ServicosController::class, 'create'])->name('servicos.create');
Route::post('/definicoes/servicos/store', [ServicosController::class, 'store'])->name('servicos.store'); 


/************* Rotas Horário *************/
Route::get('/definicoes/horario', [HorarioController::class, 'update'])->name('horario.update');

/************* Rotas Equipa *************/
Route::get('/definicoes/equipa', [EquipaController::class, 'index'])->name('equipa.index');
Route::get('/definicoes/equipa/update', [EquipaController::class, 'update'])->name('equipa.update');
Route::post('/definicoes/equipa/store', [EquipaController::class, 'store'])->name('equipa.store');


/************* Rotas Notificações *************/
Route::get('/definicoes/notificacoes', [NotificacoesController::class, 'update'])->name('notificacoes.update');

/******************** Rotas Autenticação ********************/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
