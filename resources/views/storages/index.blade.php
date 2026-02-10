@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Depósitos</h2>
    <button onclick="document.getElementById('modalStorage').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
        + Novo Depósito
    </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse($storages as $storage)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800">{{ $storage->name }}</h3>
            </div>
            <p class="text-sm text-gray-500 font-medium">Local: {{ $storage->location ?? 'Não definido' }}</p>
            <div class="mt-4 pt-4 border-t border-gray-50">
                <a href="{{ route('inventory.index', ['storage_id' => $storage->id]) }}" 
                class="text-blue-600 text-sm font-bold hover:underline">
                    Ver Inventário →
                </a>
            </div>
        </div>
    @empty
        <p class="col-span-3 text-center text-gray-500 py-10">Nenhum depósito cadastrado.</p>
    @endforelse
</div>

<div id="modalStorage" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-md">
        <h3 class="text-xl font-bold mb-6 text-gray-800">Cadastrar Novo Depósito</h3>
        <form action="{{ route('storages.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nome do Local</label>
                    <input type="text" name="name" required placeholder="Ex: Almoxarifado A" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Localização/Referência</label>
                    <input type="text" name="location" placeholder="Ex: Bloco B, 2º Andar" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="mt-8 flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('modalStorage').classList.add('hidden')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-lg">Salvar Depósito</button>
            </div>
        </form>
    </div>
</div>
@endsection