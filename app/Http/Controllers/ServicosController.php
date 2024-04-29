<?php

namespace App\Http\Controllers;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicosController extends Controller
{

    public function index()
    {    
        return view('pages.servicos.index', ["servicos"=>Servico::all()]);
    }

    public function create()
    {
        return view('pages.servicos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string',
            'duracao' => 'required|integer',
            'preco' => 'required|numeric',
            'cor' => 'required|string',
        ]);

        $servico = Servico::create([
            'nome' => $data['nome'],
            'duracao' => $data['duracao'],
            'preco' => $data['preco'],
            'cor' => $data['cor'],
        ]);

        return redirect()->back()->with('success', 'Serviço criado com sucesso');
    }

    
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'duracao' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'cor' => 'required|string|max:255',
        ]);
    
        // Encontrar o serviço pelo ID
        $servico = Servico::findOrFail($id);
    
        // Atualizar os dados do serviço com base nos dados do formulário
        $servico->nome = $request->input('nome');
        $servico->duracao = $request->input('duracao');
        $servico->preco = $request->input('preco');
        $servico->cor = $request->input('cor');
    
        // Salvar as alterações no banco de dados
        $servico->save();
    
        // Redirecionar para uma rota adequada após a atualização
        return redirect()->back()->with('success', 'Serviço criado com sucesso');
    }
    
public function edit($id)
{
    $servico = Servico::findOrFail($id);
    return view('pages.servicos.edit', compact('servico'));
}


}