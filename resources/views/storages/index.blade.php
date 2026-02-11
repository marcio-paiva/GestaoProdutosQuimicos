@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center px-2">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Depósitos</h2>
        <p class="text-gray-500 mt-1">Monitore a ocupação e capacidade dos locais de armazenamento.</p>
    </div>
    <a href="{{ route('storages.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold no-underline inline-flex items-center">
        Novo Depósito
    </a>
</div>

<div class="mb-12"> 
    <div class="w-full">
        <input type="text" id="searchInput" onkeyup="filterStorages()" 
               class="block w-full px-6 py-4 border border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent sm:text-sm transition-all shadow-sm font-medium" 
               placeholder="Digite o nome do depósito para buscar...">
    </div>
</div>

<div id="storageGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
    @foreach($storages as $storage)
        @php
            $percent = ($storage->inventory_count / 50) * 100;
            $status = $percent > 90 ? 'Alerta' : ($percent > 70 ? 'Atenção' : 'Normal');
            $colorHex = $percent > 90 ? '#ef4444' : ($percent > 70 ? '#f59e0b' : '#10b981');
            $colorClass = $percent > 90 ? 'red' : ($percent > 70 ? 'yellow' : 'green');
        @endphp

        <div class="storage-card bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 hover:shadow-xl transition-all duration-300 flex flex-col border-t-4" 
             style="border-top-color: {{ $colorHex }};">
            
            <div class="flex justify-end mb-4">
                <span class="text-[9px] font-bold uppercase px-3 py-1 rounded-full bg-{{ $colorClass }}-50 text-{{ $colorClass }}-600 border border-{{ $colorClass }}-100 shadow-sm">
                    {{ $status }}
                </span>
            </div>

            <div class="text-center mb-10">
                <h3 class="storage-name font-black text-gray-800 text-2xl mb-1 truncate px-2">{{ $storage->name }}</h3>
                <p class="text-[10px] text-gray-400 font-bold tracking-[0.2em] uppercase">
                    {{ $storage->location ?? 'LOCAL NÃO DEFINIDO' }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-3xl p-6 mb-8 border border-gray-100">
                <div class="flex justify-between items-center px-4">
                    <div class="text-center">
                        <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Ocupação</span>
                        <span class="text-xl font-black text-gray-800">{{ number_format($percent, 0) }}%</span>
                    </div>
                    <div class="w-px h-8 bg-gray-200"></div>
                    <div class="text-center">
                        <span class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Estoque</span>
                        <span class="text-xl font-black text-gray-800">{{ $storage->inventory_count }}<span class="text-xs text-gray-400 font-bold ml-1">/50</span></span>
                    </div>
                </div>
            </div>

            <div class="px-2 mb-10">
                <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 ease-out" 
                         style="width: {{ $percent }}%; background-color: {{ $colorHex }};">
                    </div>
                </div>
            </div>

            <div class="flex justify-center mt-auto">
                <a href="{{ route('inventory.index', ['storage_id' => $storage->id]) }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold text-sm border-none no-underline inline-block">
                    Ver Inventário
                </a>
            </div>
        </div>
    @endforeach
</div>

<script>
function filterStorages() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let grid = document.getElementById('storageGrid');
    let cards = grid.getElementsByClassName('storage-card');

    for (let i = 0; i < cards.length; i++) {
        let name = cards[i].querySelector('.storage-name').innerText;
        if (name.toLowerCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
        } else {
            cards[i].style.display = "none";
        }
    }
}
</script>
@endsection