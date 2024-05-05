<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // Verificar se o e-mail já está registrado como usuário
    $existingUser = User::where('email', $request->email)->first();

    if ($existingUser) {
        // Se o usuário já existir, redirecione-o para a página de login
        return redirect(RouteServiceProvider::LOGIN)->withErrors(['email' => 'O e-mail já está sendo utilizado.']);
    }

    // Criar um novo usuário
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    if (!$user) {
        return back()->withInput()->withErrors(['error' => 'Erro ao criar usuário.']);
    }

    // Verificar se já existe um cliente com o mesmo e-mail
    $cliente = Cliente::where('email', $request->email)->first();

    if ($cliente) {
        // Se o cliente existir, associe o usuário a ele
        $cliente->users_id = $user->id;
        $cliente->save();
    } else {
        // Se o cliente não existir, crie um novo cliente e associe o usuário a ele
        $cliente = Cliente::create([
            'nome' => $request->name,
            'email' => $request->email,
            'users_id' => $user->id,
        ]);
    }

    if (!$cliente) {
        return back()->withInput()->withErrors(['error' => 'Erro ao criar cliente.']);
    }

    //event(new Registered($user));

    Auth::login($user);

    return redirect(RouteServiceProvider::CLIENT_HOME);
}
}
