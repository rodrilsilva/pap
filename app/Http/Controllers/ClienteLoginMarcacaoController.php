<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Marcacao;
use App\Models\Servico;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClienteLoginMarcacaoController extends Controller
{
    public function create()
    {
        $servicos = Servico::all();
        return view('pages.cliente.index', compact('servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'servico' => 'required',
            'data' => 'required|date',
            'hora' => 'required',
        ]);

        try {
            $userId = Auth::id();
            
            $clienteId = Cliente::where('users_id', $userId)->value('id');

            if ($clienteId) {
                $horarioSelecionado = Carbon::createFromFormat('Y-m-d H:i', $request->data . ' ' . $request->hora);
                $horarioOcupado = Marcacao::where('data_hora', $horarioSelecionado)->exists();

                if ($horarioOcupado) {
                    return redirect()->back()->with('error', 'Este horário já está ocupado. Por favor, escolha outro horário.');
                }

                $novaMarcacao = new Marcacao();
                $novaMarcacao->tipo_servico_id = $request->servico;
                $novaMarcacao->data_hora = $horarioSelecionado;
                $novaMarcacao->cliente_id = $clienteId;
                $novaMarcacao->save();

                return redirect()->route('marcacoes.cliente')->with('success', 'Marcação criada com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Cliente não encontrado para este usuário.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar marcação: ' . $e->getMessage());
        }
    }
}
