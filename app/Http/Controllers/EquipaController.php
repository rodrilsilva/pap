<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador; // Certifique-se de importar o modelo de Colaborador

class EquipaController extends Controller
{
    /**
     * Mostra a página de atualização da equipa.
     *
     * @return \Illuminate\View\View
     */
    public function update()
    {
        $colaboradores = Colaborador::all(); // Obtém todos os colaboradores
        return view('pages.equipa.index', compact('colaboradores'));
    }

    /**
     * Armazena um novo colaborador na base de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Mapear valores de entrada para valores do banco de dados
        $generos = [
            'masculino' => 1,
            'feminino' => 2,
            'outro' => 0,
        ];

        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'gen' => 'required|string|in:masculino,feminino,outro',
        ]);

        // Cria um novo colaborador
        $colaborador = new Colaborador();
        $colaborador->nome = $validatedData['nome'];
        $colaborador->gen = $generos[$validatedData['gen']]; // Atribuir valor mapeado
        $colaborador->save();

        // Redireciona de volta para a página de atualização com uma mensagem de sucesso
        return redirect()->route('equipa.update')->with('success', 'Colaborador adicionado com sucesso!');
    }
}
