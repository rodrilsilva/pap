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


    public function update()
    {
        return view('pages.servicos.index');
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

}