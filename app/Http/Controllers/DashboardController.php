<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Fatura;
use App\Models\Marcacao;

class DashboardController extends Controller
{
    public function index()
    {
        // Recupera todos os clientes do banco de dados
        $marcacoes = Marcacao::all();

        $numeroClientes = Cliente::count();
        $numeroMarcacoes = Marcacao::count();

        // Calcular o dinheiro faturado somando o preço final de todas as faturas
        $dinheiroFaturado = Fatura::sum('preco_final');

        // Buscar a próxima marcação
        $marcacao = new Marcacao();
        $proximaMarcacao = $marcacao->proximaMarcacao();

        return view('pages.dashboard', [
            'numeroClientes' => $numeroClientes,
            'numeroMarcacoes' => $numeroMarcacoes,
            'dinheiroFaturado' => $dinheiroFaturado,
            'proximaMarcacao' => $proximaMarcacao
        ]);
    }
}
