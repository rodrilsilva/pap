<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Fatura;
use App\Models\Marcacao;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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



    public function getEvents(Request $request)
    {
        // Obter a data inicial e final para a visualização semanal
        $start = Carbon::parse($request->start)->startOfWeek()->toDateString();
        $end = Carbon::parse($request->end)->endOfWeek()->toDateString();
    
        // Consulta para obter os eventos
        $eventos = Marcacao::with(['cliente', 'colaborador', 'tipoServico'])
                            ->whereBetween('data_hora', [$start, $end])
                            ->get()
                            ->map(function ($evento) {
                                // Construir o título do evento
                                $titulo = $evento->cliente->nome . ' - ' . $evento->tipoServico->nome;
    
                                // Formatar a data e hora
                                $dataHora = Carbon::parse($evento->data_hora)->toDateTimeString();
    
                                // Calcular a duração do serviço em minutos
                                $duracao = $evento->tipoServico->duracao; 
    
                                // Obter a cor do tipo de serviço
                                $cor = $evento->tipoServico->cor;
    
                                return [
                                    'id' => $evento->id,
                                    'title' => $titulo,
                                    'start' => $dataHora,
                                    'end' => Carbon::parse($dataHora)->addMinutes($duracao)->toDateTimeString(),
                                    'color' => $cor, // Adicionar a cor do tipo de serviço
                                ];
                            });
    
        return response()->json($eventos);
    }
}
