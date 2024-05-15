<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config;

class DefinicoesController extends Controller
{
    public function update()
    {
        $configuracoes = Config::first();

        if ($configuracoes) {
            return view('pages.definicoes.update', ['configuracoes' => $configuracoes]);
        } else {
            return view('pages.definicoes.update');
        }
    }


    public function save(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'telefone' => 'nullable|numeric',
            'telemovel' => 'nullable|numeric',
            'morada' => 'nullable',
        ]);

        $configuracoes = Config::firstOrNew();

        $configuracoes->nome = $request->input('nome');
        $configuracoes->telefone = $request->input('telefone');
        $configuracoes->telemovel = $request->input('telemovel');
        $configuracoes->morada = $request->input('morada');

        $configuracoes->save();

        return redirect()->route('definicoes.update')->with('success', 'Configurações salvas com sucesso!');
    }
}
