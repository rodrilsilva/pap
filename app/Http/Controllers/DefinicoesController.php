<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Config; // Importe o modelo Config aqui

class DefinicoesController extends Controller
{
    public function update()
    {
        // Recupere as configurações existentes
        $configuracoes = Config::first();

        // Verifique se as configurações já existem
        if ($configuracoes) {
            return view('pages.definicoes.update', ['configuracoes' => $configuracoes]);
        } else {
            // Se as configurações não existirem, retorne a view sem dados
            return view('pages.definicoes.update');
        }
    }


    public function save(Request $request)
    {
        // Valide os dados do formulário
        $request->validate([
            'nome' => 'required',
            'telefone' => 'nullable|numeric',
            'telemovel' => 'nullable|numeric',
            'morada' => 'nullable',
        ]);

        // Atualize as configurações existentes ou crie novas
        $configuracoes = Config::firstOrNew();

        $configuracoes->nome = $request->input('nome');
        $configuracoes->telefone = $request->input('telefone');
        $configuracoes->telemovel = $request->input('telemovel');
        $configuracoes->morada = $request->input('morada');

        $configuracoes->save();

        // Redirecione de volta para a página de configurações com uma mensagem de sucesso
        return redirect()->route('definicoes.update')->with('success', 'Configurações salvas com sucesso!');
    }
}
