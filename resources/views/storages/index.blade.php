@extends('layouts.app')

@section('content')
<div class="mb-6 flex justify-between items-center px-2">
    <div>
        <h2 class="text-3xl font-extrabold text-gray-800 tracking-tight">Depósitos</h2>
        <p class="text-gray-500 mt-1">Monitore a ocupação e capacidade dos locais de armazenamento.</p>
    </div>
    <button onclick="document.getElementById('modalStorage').classList.remove('hidden')" 
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold border-none cursor-pointer">
        Novo Depósito
    </button>
</div>

<div class="mb-12"> <div class="w-full">
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

<div id="modalStorage" class="hidden fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-md flex items-center justify-center z-50 p-4">
    <div class="bg-white p-10 rounded-[2.5rem] shadow-2xl w-full max-w-md border border-gray-100">
        <div class="flex justify-between items-center mb-10">
            <h3 class="text-2xl font-black text-gray-800 tracking-tight">Novo Depósito</h3>
            <button onclick="document.getElementById('modalStorage').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition-colors border-none bg-transparent cursor-pointer">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('storages.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Identificação</label>
                    <input type="text" name="name" required class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-inner font-bold text-sm" placeholder="Ex: Almoxarifado Central">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2 px-1">Localização</label>
                    <input type="text" name="location" class="w-full bg-gray-50 border-transparent rounded-2xl p-4 focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all shadow-inner font-bold text-sm" placeholder="Ex: Bloco B - Piso 1">
                </div>
            </div>
            
            <div class="mt-10">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold border-none cursor-pointer">
                    Salvar Registro
                </button>
            </div>
        </form>
    </div>
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