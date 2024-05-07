<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Marcacao;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardClienteController extends Controller
{
    public function index()
{
    // Obtendo o ID do usuário autenticado
    $userId = Auth::id();
    
    // Obtendo o ID do cliente associado ao usuário autenticado
    $clienteId = Cliente::where('users_id', $userId)->value('id');

    // Verificando se o cliente foi encontrado
    if ($clienteId) {
        // Obtendo todas as marcações associadas ao cliente
        $marcacoes = Marcacao::with(['colaborador', 'tipoServico'])
                            ->where('cliente_id', $clienteId)
                            ->orderBy('data_hora', 'asc')
                            ->get();

        // Iterando sobre as marcações para definir o estado como "Realizada" ou "Próxima"
        $marcacoes->transform(function ($marcacao) {
            $marcacao->estado = $marcacao->data_hora < Carbon::now() ? 'Realizada' : 'Próxima';
            return $marcacao;
        });
        
        // Retornando a view com as marcações
        return view('pages.cliente.dashboard', ['marcacoes' => $marcacoes]);
    } else {
        // Se o cliente não foi encontrado, redirecione com uma mensagem de erro
        return redirect()->back()->with('error', 'Cliente não encontrado para este usuário.');
    }
}

}