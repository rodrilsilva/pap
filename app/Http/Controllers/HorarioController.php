<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class HorarioController extends Controller
{
    public function update()
    {
        return view('pages.horario.update');
    }

    public function store(Request $request) {
        return $request;
    }
}