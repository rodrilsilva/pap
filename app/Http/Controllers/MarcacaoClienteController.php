<?php

namespace App\Http\Controllers;

use App\Models\Marcacao;
use Illuminate\Support\Facades\Auth;

class MarcacaoController extends Controller
{
    public function index()
    {
        // Obter o ID do usuário autenticado
        $userId = Auth::id();
        
        // Obter todas as marcações associadas ao cliente com o ID do usuário logado
        $marcacoes = Marcacao::where('cliente_id', $userId)->get();
        
        // Retornar a view com as marcações
        return view('marcacoes.index', ['marcacoes' => $marcacoes]);
    }
}
