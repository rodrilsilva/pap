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

    public function index()
    {
        $clientes = Cliente::all();

        $numeroClientes = $clientes->count();
        $proximasMarcacoes = [];
        $numeroMarcacoes = [];

        foreach ($clientes as $cliente) {
            $proximaMarcacao = $cliente->proximaMarcacao();
            
            if ($proximaMarcacao) {
                $proximaMarcacaoFormatada = date('d-m-Y H:i', strtotime($proximaMarcacao->data_hora));
        
                $proximasMarcacoes[$cliente->id] = $proximaMarcacaoFormatada;
            }

            $numeroMarcacoes[$cliente->id] = $cliente->marcacoes()->count();
        }

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
