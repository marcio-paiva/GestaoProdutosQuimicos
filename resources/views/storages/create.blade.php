@extends('layouts.app')

@section('title', 'Depósito')
@section('content')
<div class="px-2">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Novo Depósito</h2>
        <p class="text-gray-500 font-medium">Cadastre um novo local de armazenamento</p>
    </div>

    <div class="bg-white p-8 rounded-[2rem] border border-gray-100 shadow-sm max-w-2xl">
        <form action="{{ route('storages.store') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome do Depósito</label>
                <input type="text" name="name" required class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm">
            </div>

            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-2">Descrição / Localização</label>
                <textarea name="location" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"></textarea>
            </div>

            <div class="flex items-center justify-end gap-4 mt-8">
                <a href="{{ route('storages.index') }}" 
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