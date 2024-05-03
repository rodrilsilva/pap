<?php

namespace App\Http\Controllers;
use App\Models\Marcacao;
use App\Models\Servico;
use App\Models\Horario;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importe da classe Auth

class MarcacaoController extends Controller
{


    public function create()
    {
        $servicos = Servico::all();
        return view('welcome', compact('servicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tel' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'servico' => 'required|string|max:255',
        ]);

        Marcacao::create([
            'nome' => $request->input('nome'),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
            'servico' => $request->input('servico'),
        ]);

        return redirect()->route('welcome')->with('success', 'Marcação criada com sucesso!');
    }


    


    public function horariosDisponiveis(Request $request)
{
    $dataSelecionada = $request->input('data');
    $servicoSelecionado = $request->input('servico');

    // Lógica para buscar os horários disponíveis com base na data e no serviço selecionado
    // Isso pode envolver consulta ao banco de dados ou qualquer outra fonte de dados
    // Por enquanto, vamos simular os horários disponíveis com alguns dados estáticos
    $horariosDisponiveis = ['08:00', '09:00', '10:00', '11:00', '14:00', '15:00', '16:00'];

    return response()->json($horariosDisponiveis);
}

    

}
