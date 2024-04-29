<?php

namespace App\Http\Controllers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Models\Marcacao;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\Servico;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AgendaController extends Controller
{
    public function index()
    {
        return view('pages.agenda.index', ['servicos' => Servico::all(), 'colaboradores' => Colaborador::all(), 'clientes' => Cliente::all()]);
    }

    public function getEvents()
    {
        $eventos = Marcacao::with(['cliente', 'colaborador', 'tipoServico'])
                            ->get()
                            ->map(function ($evento) {
                                $titulo = $evento->cliente->nome . ' - ' . $evento->tipoServico->nome;
                                $dataHora = Carbon::parse($evento->data_hora)->toDateTimeString(); // para formatar a data e hora
                                $duracao = $evento->tipoServico->duracao; 
                                $cor = $evento->tipoServico->cor;
    
                                return [
                                    'id' => $evento->id,
                                    'title' => $titulo,
                                    'start' => $dataHora,
                                    'end' => Carbon::parse($dataHora)->addMinutes($duracao)->toDateTimeString(),
                                    'color' => $cor,
                                ];
                            });
    
        return response()->json($eventos);
    }

public function update(Request $request, $id)
{
    $marcacao = Marcacao::findOrFail($id);

    // Obtenha as datas e horas diretamente do input e ajuste o formato conforme necessário
    $start_date = Carbon::parse($request->input('start_date'))->format('Y-m-d\TH:i:s'); 
    $end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d\TH:i:s');

    // Atualize as datas e horas no modelo Marcacao
    $marcacao->update([
        'data_hora' => $start_date,
        'end_date' => $end_date
    ]);

    return response()->json(['message' => 'Marcação movida com sucesso']);
}

    public function create()
    {
        return view('pages.agenda.index', ['servicos' => Servico::all(), 'colaboradores' => Colaborador::all()]);
    }

    public function store(Request $request)
    {
        // validar os dados
        $validatedData = $request->validate([
            'data_hora' => 'required|date',
            'servico_id' => 'required|exists:tipo_servico,id',
            'colaborador_id' => 'required|exists:colaborador,id',
            'cliente_id' => 'required|exists:cliente,id',
        ]);

        try {
            // criacao da marcacao
            $marcacao = new Marcacao();
            $marcacao->data_hora = $validatedData['data_hora'];
            $marcacao->estado = null;
            $marcacao->cliente_id = $validatedData['cliente_id'];
            $marcacao->colaborador_id = $validatedData['colaborador_id'];
            $marcacao->tipo_servico_id = $validatedData['servico_id'];
            $marcacao->save();

            return redirect()->route('agenda.index')->with('success', 'Marcação criada com sucesso');

        } catch (\Exception $e) {
            return redirect()->route('agenda.index')->with('error', 'Erro ao criar a marcação: ' . $e->getMessage());
        }
    }

    public function deleteEvent($id)
    {
        $marcacao = Marcacao::findOrFail($id);
        $marcacao -> delete();

        return response()->json(['message' => 'Marcacao apagada com sucesso']);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

}
