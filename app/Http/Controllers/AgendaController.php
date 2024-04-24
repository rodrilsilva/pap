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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.agenda.index', ['servicos' => Servico::all(), 'colaboradores' => Colaborador::all(), 'clientes' => Cliente::all()]);
    }

    /**public function getEvents()
    {
        $schedules=Schedule::all();
        return response()->json($schedules);
    }

    Route::get('/events', [AgendaController::class, 'getEvents']);
    */


    public function getEvents()
    {
        $eventos = Marcacao::with(['cliente', 'colaborador', 'tipoServico'])
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
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $schedule=Schedule::findOrFail($id);

        $schedule->update([
            'start'=>Carbon::parse($request->input('start_date'))->setTimeZone('UTC'),
            'end'=>Carbon::parse($request->input('end_date'))->setTimeZone('UTC'),
        ]);

        return response()->json(['message' => 'Marcacao movida com sucesso']);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.agenda.index', ['servicos' => Servico::all(), 'colaboradores' => Colaborador::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Armazena uma nova marcação na base de dados.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function store(Request $request)
{
    dd($request->all());
    // Validação dos dados do formulário
    $validatedData = $request->validate([
        'data_hora' => 'required|date',
        'servico_id' => 'required|exists:tipo_servico,id',
        'colaborador_id' => 'required|exists:colaborador,id',
        'cliente_id' => 'required|exists:cliente,id',
        // outros campos
    ]);

    try {
        // Cria uma nova marcação
        $marcacao = new Marcacao();
        $marcacao->data_hora = $validatedData['data_hora'];
        $marcacao->estado = null; // ou outro valor padrão
        $marcacao->cliente_id = $validatedData['cliente_id'];
        $marcacao->colaborador_id = $validatedData['colaborador_id'];
        $marcacao->tipo_servico_id = $validatedData['servico_id'];
        // outros campos
        $marcacao->save();

        // Redireciona de volta para a página de agenda com uma mensagem de sucesso
        return redirect()->route('agenda.index')->with('success', 'Marcação criada com sucesso');

    } catch (\Exception $e) {
        // Redireciona de volta para a página de agenda com uma mensagem de erro em caso de falha
        return redirect()->route('agenda.index')->with('error', 'Erro ao criar a marcação: ' . $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
