<?php

namespace App\Http\Controllers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Models\Marcacao;
use Illuminate\Support\Carbon;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('pages.agenda.index');
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
