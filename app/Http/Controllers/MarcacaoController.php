<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;


use App\Models\Marcacao;
use App\Models\Servico;
use App\Models\Cliente;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarcacaoController extends Controller
{
    public function create()
    {
        $servicos = Servico::all();
        return view('welcome', compact('servicos'));
    }


    public function store(Request $request)
{
    // Valida os dados recebidos do formulário para a marcação e para o cliente
    $request->validate([
        // Validação para os campos da marcação...
        'nome' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'tlm' => 'required|string|max:255',
        // Adicione validações para outros campos do cliente, se necessário...
    ]);

    try {
        // Verifica se já existe um cliente com o email fornecido
        $cliente = Cliente::where('email', $request->input('email'))->first();

        // Se não houver cliente com o email fornecido, cria um novo cliente
        if (!$cliente) {
            $cliente = Cliente::create([
                'nome' => $request->input('nome'),
                'email' => $request->input('email'),
                'tlm' => $request->input('tlm'),
                // Adicione outros campos do cliente, se necessário...
            ]);
        }

        // Cria uma nova marcação associada ao cliente existente ou recém-criado
        $marcação = new Marcacao([
            'data_hora' => Carbon::createFromFormat('Y-m-d H:i', $request->input('data') . ' ' . $request->input('hora')),
            'tipo_servico_id' => $request->input('servico'),
        ]);

        // Associa a marcação ao cliente
        $cliente->marcacoes()->save($marcação);

        // Marcação criada com sucesso, redirecione com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Marcação criada com sucesso!');
    } catch (\Exception $e) {
        // Se ocorrer um erro ao criar a marcação ou o cliente, redirecione com uma mensagem de erro
        return redirect()->back()->with('error', 'Erro ao criar marcação: ' . $e->getMessage());
    }
}



    public function horariosDisponiveis(Request $request)
    {
        $dataSelecionada = $request->input('data');
        $servicoSelecionado = $request->input('servico');

        // Obter todas as marcações para o serviço e data selecionados
        $marcacoes = Marcacao::whereDate('data_hora', $dataSelecionada)
                             ->where('tipo_servico_id', $servicoSelecionado)
                             ->get();
                    
    // Inicializar um array para armazenar as horas ocupadas
    $horasOcupadas = [];

    // Iterar sobre as marcações e adicionar as horas ocupadas ao array
    foreach ($marcacoes as $marcacao) {
        // Calcular a hora de início e a hora de término da marcação
        $horaInicio = Carbon::parse($marcacao->data_hora)->format('H:i');
        $horaTermino = Carbon::parse($marcacao->data_hora)->addMinutes($marcacao->duracao_minutos)->format('H:i');

        // Adicionar intervalo ocupado ao array
        $horasOcupadas[] = [
            'inicio' => $horaInicio,
            'fim' => $horaTermino
        ];
    }

    // Definir o intervalo de horário de funcionamento do salão
    $horaInicio = Carbon::createFromTime(8, 30); // 8:30
    $horaFimManha = Carbon::createFromTime(12, 0); // 12:00
    $horaInicioTarde = Carbon::createFromTime(14, 0); // 14:00
    $horaFim = Carbon::createFromTime(19, 0); // 19:00

    // Inicializar um array para armazenar as horas disponíveis
    $horasDisponiveis = [];

    // Iterar sobre o intervalo de horas de funcionamento e encontrar as horas disponíveis
    for ($hora = $horaInicio; $hora <= $horaFim; $hora->addMinutes(30)) {
        // Verificar se a hora está dentro do intervalo de funcionamento
        if (($hora >= $horaInicio && $hora < $horaFimManha) || ($hora >= $horaInicioTarde && $hora < $horaFim)) {
            // Verificar se a hora não está ocupada
            $horaFormatada = $hora->format('H:i');
            $ocupada = false;
            foreach ($horasOcupadas as $intervalo) {
                if ($horaFormatada >= $intervalo['inicio'] && $horaFormatada < $intervalo['fim']) {
                    $ocupada = true;
                    break;
                }
            }
            if (!$ocupada) {
                $horasDisponiveis[] = $horaFormatada;
            }
        }
    }

    return response()->json($horasDisponiveis);
}




}
