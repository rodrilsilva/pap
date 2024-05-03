<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteMarcacaoController extends Controller
{
    public function index()
    {
        // Verificar se o usuário está autenticado e se é um cliente
        if (Auth::check() && Auth::user()->cliente) {
            // Recuperar o cliente autenticado
            $cliente = Auth::user()->cliente;
            // Recuperar as marcações do cliente
            $marcacoes = $cliente->marcacoes;
            // Retornar a view com as marcações do cliente
            return view('includes.dashboard-cliente', compact('marcacoes'));
        }
        // Se não houver marcações ou o usuário não estiver autenticado como cliente, redirecione para a página de login ou exiba uma mensagem de erro
        return redirect()->route('login')->with('error', 'Você não possui marcações associadas.');
    }

    // Adicione outros métodos conforme necessário, como criar, armazenar, editar, excluir marcações, etc.
}
