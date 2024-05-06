<?php

namespace App\Http\Controllers;

use App\Models\Marcacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardClienteController extends Controller
{
    public function index()
    {
        // Obter o ID do usuário autenticado
        $userId = Auth::id();
        
        // Obter todas as marcações associadas ao cliente com o ID do usuário logado
        $marcacoes = Marcacao::with(['colaborador', 'tipoServico'])
                        ->where('cliente_id', $userId)
                        ->orderBy('data_hora', 'asc') // Ordenar as marcações pela data e hora
                        ->get();
    
        // Iterar sobre as marcações para definir o estado como "Realizada" ou "Próxima"
        $marcacoes->transform(function ($marcacao) {
            $marcacao->estado = $marcacao->data_hora < Carbon::now() ? 'Realizada' : 'Próxima';
            return $marcacao;
        });
        
        // Retornar a view com as marcações
        return view('pages.cliente.dashboard', ['marcacoes' => $marcacoes]);
    }
}
