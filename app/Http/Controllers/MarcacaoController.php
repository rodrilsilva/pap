<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Marcacao;
use App\Models\Servico;
use App\Models\Cliente;
use DateInterval;
use DatePeriod;

class MarcacaoController extends Controller
{
    public function create()
    {
        $servicos = Servico::all();
        return view('welcome', compact('servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tlm' => 'required|string|max:255',
            'data' => 'required|date',
            'hora' => 'required'
        ]);

        try {
            $cliente = Cliente::firstOrCreate(
                ['email' => $request->input('email')],
                [
                    'nome' => $request->input('nome'),
                    'tlm' => $request->input('tlm')
                ]
            );

            $marcação = new Marcacao([
                'data_hora' => Carbon::createFromFormat('Y-m-d H:i', $request->input('data') . ' ' . $request->input('hora')),
                'tipo_servico_id' => $request->input('servico'),
            ]);

            $cliente->marcacoes()->save($marcação);
            return redirect()->back()->with('success', 'Marcação criada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar marcação: ' . $e->getMessage());
        }
    }

    public function horariosDisponiveis(Request $request)
{
    $dataSelecionada = $request->input('data');
    $servicoSelecionado = $request->input('servico');

    // Obtém todas as marcações agendadas para o dia selecionado
    $marcacoes = Marcacao::whereDate('data_hora', $dataSelecionada)
                        ->get();

    // Calcula os horários ocupados considerando a duração de cada serviço
    $horariosOcupados = [];
    foreach ($marcacoes as $marcacao) {
        $duracao = Servico::find($marcacao->tipo_servico_id)->duracao;
        $horarioInicio = Carbon::parse($marcacao->data_hora);
        $horarioFim = $horarioInicio->copy()->addMinutes($duracao);

        // Adiciona o intervalo ocupado na lista de horários ocupados
        $horariosOcupados[] = [$horarioInicio, $horarioFim];
    }

    // Calcula os horários disponíveis com base nos horários ocupados
    $horarioInicioDia = Carbon::parse($dataSelecionada)->setHour(8)->setMinute(30);
    $horarioFimDia = Carbon::parse($dataSelecionada)->setHour(18)->setMinute(30);
    $intervalo = new DateInterval('PT30M'); // Intervalo de 30 minutos
    $periodo = new DatePeriod($horarioInicioDia, $intervalo, $horarioFimDia);
    $horariosDisponiveis = [];

    foreach ($periodo as $hora) {
        $disponivel = true;
        foreach ($horariosOcupados as $ocupado) {
            // Verifica se a hora atual está dentro de um intervalo ocupado
            if ($hora >= $ocupado[0] && $hora < $ocupado[1]) {
                $disponivel = false;
                break;
            }
        }
        if ($disponivel) {
            $horariosDisponiveis[] = $hora->format('H:i');
        }
    }

    return response()->json($horariosDisponiveis);
}

}
