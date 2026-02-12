<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Exibe a listagem de usuários (Gestão de Acessos).
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (!$user->hasRole('adm')) {
            abort(403, 'Acesso restrito a administradores.');
        }

        $users = \App\Models\User::latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Você pode usar este método para salvar o usuário vindo da tela de Gestão,
     * centralizando aqui em vez de usar o RegisteredUserController.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:solicitante,avaliador,admin,adm'],
            'department' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'department' => $request->department,
            'job_title' => $request->job_title,
            'status' => 'Ativo',
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso!');
    }

    /**
     * Método para ativar/desativar usuário (Útil para o campo Status do protótipo)
     */
    public function toggleStatus(User $user)
    {
        $newStatus = $user->status === 'Ativo' ? 'Inativo' : 'Ativo';
        $user->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Status do usuário atualizado!');
    }
}