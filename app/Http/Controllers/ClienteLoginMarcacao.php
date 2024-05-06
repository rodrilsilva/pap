<?php

namespace App\Http\Controllers;

use App\Models\Marcacao;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteLoginMarcacao extends Controller
{
    public function create()
    {
        $servicos = Servico::all();
        return view('pages.cliente.index', compact('servicos'));
    }

    public function store(Request $request)
    {
        dd($request->all());
        // Validação dos dados da requisição
        $request->validate([
            'servico' => 'required',
            'data' => 'required|date',
            'hora' => 'required'
        ]);

        try {
            // Obtém o cliente autenticado
            $cliente = Auth::user()->cliente;

            // Cria a marcação associada ao cliente
            $marcação = new Marcacao([
                'data_hora' => Carbon::createFromFormat('Y-m-d H:i', $request->input('data') . ' ' . $request->input('hora')),
                'tipo_servico_id' => $request->input('servico'),
            ]);

            $cliente->marcacoes()->save($marcação);

            // Redireciona com uma mensagem de sucesso
            return redirect()->back()->with('success', 'Marcação criada com sucesso!');
        } catch (\Exception $e) {
            // Se ocorrer um erro, redireciona com uma mensagem de erro
            return redirect()->back()->with('error', 'Erro ao criar marcação: ' . $e->getMessage());
        }
    }
}
