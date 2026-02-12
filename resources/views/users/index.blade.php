@extends('layouts.app')

@section('title', 'Gestão de Acessos')

@section('content')
<div class="px-2">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-black text-gray-800 tracking-tight">Gestão de Acessos</h2>
            <p class="text-gray-500 font-medium">Gerencie usuários e permissões do sistema</p>
        </div>
        
        <a href="{{ route('register') }}" class="bg-black text-white px-6 py-2 rounded-lg transition shadow-md font-bold inline-flex items-center gap-2 h-[40px]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            Novo Usuário
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h4 class="text-sm font-bold text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Usuários do Sistema
            </h4>
        </div>

        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Nome</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">E-mail</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Departamento</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Cargo</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center">Nível de Acesso</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Último Acesso</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="p-6 font-bold text-gray-800">{{ $user->name }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="p-6 text-sm text-gray-600">{{ $user->department ?? '-' }}</td>
                    <td class="p-6 text-sm text-gray-600">{{ $user->job_title ?? '-' }}</td>
                    <td class="p-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase
                            {{ $user->role == 'admin' ? 'bg-purple-50 text-purple-600' : '' }}
                            {{ $user->role == 'avaliador' ? 'bg-blue-50 text-blue-600' : '' }}
                            {{ $user->role == 'solicitante' ? 'bg-gray-100 text-gray-600' : '' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="p-6 text-xs text-gray-500">
                        {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Nunca' }}
                    </td>
                    <td class="p-6 text-center">
                        <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase {{ $user->status == 'Ativo' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $user->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection