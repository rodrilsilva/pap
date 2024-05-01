<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacao;

class NotificacoesController extends Controller
{

    public function index()
    {    
        return view('pages.notificacoes.index', ["servicos"=>Notificacao::all()]);
    }

    public function update()
    {
        return view('pages.notificacoes.index');
    }
}
