<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Marcacao;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Recupera todos os clientes do banco de dados
    $clientes = Cliente::all();

    // Conta o número de clientes
    $numeroClientes = $clientes->count();

    // Array para armazenar a próxima marcação para cada cliente
    $proximasMarcacoes = [];

    // Array para armazenar o número de marcações para cada cliente
    $numeroMarcacoes = [];

    // Percorre todos os clientes para calcular a próxima marcação e contar o número de marcações
    foreach ($clientes as $cliente) {
        // Busca a próxima marcação para o cliente
        $proximaMarcacao = $cliente->proximaMarcacao();
        
        // Verifica se há uma próxima marcação
        if ($proximaMarcacao) {
            // Formata a data da próxima marcação para exibir apenas até o minuto
            $proximaMarcacaoFormatada = date('d-m-Y H:i', strtotime($proximaMarcacao->data_hora));
    
            // Armazena a próxima marcação no array
            $proximasMarcacoes[$cliente->id] = $proximaMarcacaoFormatada;
        }

        // Conta o número de marcações para o cliente
        $numeroMarcacoes[$cliente->id] = $cliente->marcacoes()->count();
    }

    // Passe os clientes, o número de clientes, as próximas marcações e o número de marcações para a visão
    return view('pages.clientes.index', [
        'clientes' => $clientes,
        'numeroClientes' => $numeroClientes,
        'proximasMarcacoes' => $proximasMarcacoes,
        'numeroMarcacoes' => $numeroMarcacoes,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create($request->all());

        return redirect()->back()->with('success', 'Cliente criado com sucesso');
        //return redirect()->route('clientes.show')->with('success', 'Cliente criado com sucesso');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('pages.clientes.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    $cliente = Cliente::findOrFail($id);

    $cliente->update($request->all());

    $cliente->save();

    return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    $cliente = Cliente::findOrFail($id);

    $cliente->delete();

    return redirect()->route('clientes.index')->with('success', 'Cliente apagado com sucesso');
    }
}
