<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador; // Certifique-se de importar o modelo de Colaborador


class EquipaController extends Controller
{
    public function index()
    {

        return view('pages.equipa.index', ["colaboradores"=>Colaborador::all()]);
    }


    public function edit($id)
{
    $colaborador = Colaborador::findOrFail($id); // Encontra o colaborador pelo ID
    return view('pages.equipa.edit', compact('colaborador'));
}


public function update(Request $request, $id)
{
    // Validação dos dados do formulário
    $validatedData = $request->validate([
        'nome' => 'required|string|max:255',
        'gen' => 'required|string|in:masculino,feminino,outro',
    ]);

    // Encontra o colaborador pelo ID
    $colaborador = Colaborador::findOrFail($id);

    // Atualiza os dados do colaborador com base nos dados do formulário
    $colaborador->nome = $validatedData['nome'];
    $colaborador->gen = $this->mapearGenero($validatedData['gen']); // Mapeia o gênero para o valor correspondente
    $colaborador->save();

    // Redireciona de volta para a página de edição do colaborador com uma mensagem de sucesso
return redirect()->route('equipa.edit', ['id' => $id])->with('success', 'Colaborador atualizado com sucesso!');

}


private function mapearGenero($genero)
{
    $generos = [
        'masculino' => 1,
        'feminino' => 2,
        'outro' => 0,
    ];

    return $generos[$genero];
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
