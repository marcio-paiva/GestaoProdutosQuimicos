@extends('layouts.app')

@section('title', 'Gestão de Acessos')
@section('content')
<div class="px-2">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Novo Usuário</h2>
        <p class="text-gray-500 font-medium">Cadastre um novo colaborador e defina suas permissões</p>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm max-w-2xl">
        @if ($errors->any())
            <div style="background-color: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; border-radius: 1rem; margin-bottom: 1.5rem;">
                <ul style="list-style: none; padding: 0; font-size: 0.875rem;">
                    @foreach ($errors->all() as $error)
                        <li>⚠️ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome Completo</label>
                <input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">E-mail Corporativo</label>
                <input type="email" name="email" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Departamento</label>
                    <input type="text" name="department" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Cargo</label>
                    <input type="text" name="job_title" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nível de Acesso (Role)</label>
                <select name="role" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    <option value="solicitante">Solicitante</option>
                    <option value="avaliador">Avaliador</option>
                    <option value="adm">Administrador (ADM)</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-8">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Senha Provisória</label>
                    <input type="password" name="password" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8">
                <a href="{{ route('users.index') }}" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition shadow-sm font-bold no-underline inline-flex items-center justify-center border border-gray-300 text-sm h-[40px]">
                    Cancelar e Voltar
                </a>

                <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white min-w-[180px] px-6 py-2 rounded-lg transition shadow-md font-bold cursor-pointer border-none inline-flex items-center justify-center text-sm h-[40px]">
                    Confirmar Cadastro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection