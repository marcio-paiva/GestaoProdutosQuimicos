@extends('layouts.app')

@section('title', 'Inventário')
@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Entrada de Material em Estoque</h2>

    <form action="{{ route('inventory.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Produto Químico (Aprovados)</label>
                <select name="chemical_product_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecione um produto aprovado...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->cas_number ?? 'Sem CAS' }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Local de Armazenamento (Depósito)</label>
                <select name="storage_id" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Selecione o destino...</option>
                    @foreach($storages as $storage)
                        <option value="{{ $storage->id }}">{{ $storage->name }} - {{ $storage->location }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Quantidade</label>
                    <input type="number" step="0.01" name="quantity" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Unidade de Medida</label>
                    <select name="unit" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="un">Unidade (un)</option>
                        <option value="kg">Quilograma (kg)</option>
                        <option value="L">Litro (L)</option>
                        <option value="ml">Mililitro (ml)</option>
                        <option value="g">Grama (g)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Número do Lote</label>
                    <input type="text" name="lot_number" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ex: LOT-2024-001">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Data de Validade</label>
                    <input type="date" name="expiration_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        </div>

        <div class="mt-10 flex justify-end space-x-3 border-t pt-6">
            <a href="{{ route('inventory.index') }}" 
                class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition shadow-sm font-bold no-underline inline-flex items-center justify-center border border-gray-300 text-sm h-[40px]">
                Cancelar e Voltar
            </a>

            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white min-w-[180px] px-4 py-2 rounded-lg transition shadow-md font-bold cursor-pointer border-none inline-flex items-center justify-center text-sm h-[40px]">
                Confirmar Entrada
            </button>
        </div>
    </form>
</div>
@endsection