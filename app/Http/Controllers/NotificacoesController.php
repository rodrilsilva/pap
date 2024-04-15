<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificacoesController extends Controller
{
    public function update()
    {
        return view('pages.notificacoes.update');
    }
}
