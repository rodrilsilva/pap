<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Models\Horario;


class HorarioController extends Controller
{

    public function index()
    {    
        $horario = Horario::first();
        return view('pages.horario.index', compact('horario'), ["horarios"=>Horario::all()]);
    }



    public function update(Request $request, $id) {
        $request->validate([
            'hora_inicio_manha' => 'required',
            'hora_fim_manha' => 'required',
            'hora_inicio_tarde' => 'required',
            'hora_fim_tarde' => 'required',
        ]);
    
        try {
            $horario = Horario::findOrFail($id);
            $horario->hora_inicio_manha = $request->hora_inicio_manha;
            $horario->hora_fim_manha = $request->hora_fim_manha;
            $horario->hora_inicio_tarde = $request->hora_inicio_tarde;
            $horario->hora_fim_tarde = $request->hora_fim_tarde;
            $horario->save();
    
            return redirect()->route('horario.index')->with('success', 'Horário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar horário: ' . $e->getMessage());
        }
    }
    
    
}