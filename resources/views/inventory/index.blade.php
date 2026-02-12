@extends('layouts.app')

@section('title', 'Inventário')
@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-semibold text-gray-800">
            Inventário 
            @if(isset($filteredStorage)) 
                <span class="text-blue-600"> - {{ $filteredStorage }}</span> 
            @endif
        </h2>
        @if(isset($filteredStorage))
            <a href="{{ route('inventory.index') }}" class="text-xs text-gray-500 hover:text-blue-600 underline">
                Ver estoque completo (remover filtro)
            </a>
        @endif
    </div>
    <a href="{{ route('inventory.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold">
        Entrada de Estoque
    </a>
</div>

<div class="mb-8">
    <div class="w-full">
        <input type="text" id="productSearch" onkeyup="filterProducts()" 
               class="block w-full px-6 py-4 border border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent sm:text-sm transition-all shadow-sm font-medium" 
               placeholder="Digite o nome do produto para buscar no estoque...">
    </div>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="w-full text-left border-collapse" id="inventoryTable">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Produto</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Depósito</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Quantidade</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center">Validade</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-right">Lote</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($inventoryItems as $item)
                <tr class="hover:bg-gray-50/50 transition-colors product-row">
                    <td class="p-6 font-bold text-gray-800 product-name">{{ $item->product->name }}</td>
                    <td class="p-6 text-sm text-gray-600">{{ $item->storage->name }}</td>
                    <td class="p-6 text-sm font-semibold text-gray-800">
                        {{ number_format($item->quantity, 2, ',', '.') }} {{ $item->unit }}
                    </td>
                    <td class="p-6 text-center">
                        @if($item->expiration_date)
                            @php
                                $daysToExpire = \Carbon\Carbon::now()->diffInDays($item->expiration_date, false);
                                
                                $badgeClass = $daysToExpire < 0 
                                    ? 'bg-red-50 text-red-600' 
                                    : ($daysToExpire < 30 
                                        ? 'bg-orange-50 text-orange-600' 
                                        : 'bg-green-50 text-green-600'); 
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase {{ $badgeClass }}">
                                {{ \Carbon\Carbon::parse($item->expiration_date)->format('d/m/Y') }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs italic">N/A</span>
                        @endif
                    </td>
                    <td class="p-6 text-right text-sm text-gray-500 font-mono">
                        {{ $item->lot_number ?? '---' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500 italic bg-white">
                        O estoque está vazio. Realize uma entrada de produto.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
function filterProducts() {
    let input = document.getElementById('productSearch');
    let filter = input.value.toLowerCase();
    let rows = document.getElementsByClassName('product-row');

    for (let i = 0; i < rows.length; i++) {
        let nameElement = rows[i].querySelector('.product-name');
        if (nameElement) {
            let name = nameElement.innerText.toLowerCase();
            rows[i].style.display = name.includes(filter) ? "" : "none";
        }
    }
}
</script>
@endsection