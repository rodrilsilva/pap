<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteLoginMarcacao;
use App\Http\Controllers\ClienteLoginMarcacaoController;
use App\Http\Controllers\DashboardClienteController;
use App\Http\Controllers\DefinicoesController;
use App\Http\Controllers\EquipaController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\NotificacoesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarcacaoController;
use App\Models\ClienteViewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Tests\Feature\Auth\EmailVerificationTest;
use Illuminate\Http\Request;

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
})->name('welcome');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/events', [DashboardController::class, 'getEvents']);
});

/******************** Rotas Agenda ********************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/events', [AgendaController::class, 'getEvents']);
    Route::delete('/agenda/{id}', [AgendaController::class, 'deleteEvent']);
    Route::put('/agenda/{id}', [AgendaController::class, 'update']);
    Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/create', [AgendaController::class, 'create'])->name('agenda.create');
});

/******************** Rotas Clientes ********************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes/store', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/show', [ClienteController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/edit/{cliente}', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/cliente/update/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/cliente/destroy/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

/******************** Rotas Definições ********************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/definicoes', [DefinicoesController::class, 'update'])->name('definicoes.update');
    Route::post('/definicoes', [DefinicoesController::class, 'save'])->name('definicoes.save');
});

/************* Rotas Servicos *************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/definicoes/servicos', [ServicosController::class, 'index'])->name('servicos.index');
    Route::put('/definicoes/servicos/{id}', [ServicosController::class, 'update'])->name('servicos.update');
    Route::get('/definicoes/servicos/create', [ServicosController::class, 'create'])->name('servicos.create');
    Route::post('/definicoes/servicos/store', [ServicosController::class, 'store'])->name('servicos.store'); 
});


/************* Rotas Horário *************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/definicoes/horario', [HorarioController::class, 'index'])->name('horario.index');
    Route::post('/definicoes/horario/update/{id}', [HorarioController::class, 'update'])->name('horario.update');
    
});

/************* Rotas Equipa *************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/definicoes/equipa', [EquipaController::class, 'index'])->name('equipa.index');
    Route::put('/definicoes/equipa/{id}', [EquipaController::class, 'update'])->name('equipa.update');
    Route::post('/definicoes/equipa/store', [EquipaController::class, 'store'])->name('equipa.store');
    Route::get('/definicoes/equipa/{id}/editar', [EquipaController::class, 'edit'])->name('equipa.edit');
});

/************* Rotas Notificações *************/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/definicoes/notificacoes', [NotificacoesController::class, 'index'])->name('notificacoes.index');
    Route::get('/definicoes/notificacoes/update', [NotificacoesController::class, 'update'])->name('notificacoes.update');
});

/******************** Rotas Autenticação ********************/
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

/******************** Rotas Views para Dashboard dos Clientes ********************/
Route::middleware('auth')->group(function () {
    Route::get('/marcacoes.cliente', [DashboardClienteController::class, 'index'])->name('marcacoes.cliente');
});

/******************** Rotas Views formulário de marcação sem login ********************/
Route::get('/', [MarcacaoController::class, 'create'])->name('marcacao.create');
Route::get('/horarios-disponiveis', [MarcacaoController::class, 'horariosDisponiveis']);
Route::post('/criar-marcacao-wl', [MarcacaoController::class, 'store'])->name('marcacao.store');

/******************** Rotas Views formulário de marcação com login ********************/
Route::middleware('auth')->group(function () {
    Route::get('/criar-marcacao', [ClienteLoginMarcacaoController::class, 'create'])->name('cliente.index');
    Route::post('/criar-marcacao/create', [ClienteLoginMarcacaoController::class, 'store'])->name('cliente.create');
    //Route::get('/obter-cliente-id', [ClienteLoginMarcacao::class, 'suaFuncao'])->name('cliente.obter-cliente-id');
});

require __DIR__.'/auth.php';
