@extends('layouts.app')

@section('title', 'Fichas de Segurança (FDS)')

@section('content')
<div class="px-2">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Fichas de Segurança (FDS)</h2>
        <p class="text-gray-500 font-medium">Visualize e monitore as fichas de dados de segurança e classificações GHS</p>
    </div>

    <div class="flex flex-row space-x-4 mb-10 overflow-x-auto pb-4 md:pb-0">
        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total de FDS</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $totalFds }}</h3>
            </div>
            <div class="bg-blue-50 p-4 rounded-2xl text-blue-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
        </div>

        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Atualizadas</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $atualizadas }}</h3>
            </div>
            <div class="bg-green-50 p-4 rounded-2xl text-green-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Requer Revisão</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $requerRevisao }}</h3>
            </div>
            <div class="bg-orange-50 p-4 rounded-2xl text-orange-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <input type="text" id="fdsSearch" onkeyup="filterFds()" 
               class="w-full px-6 py-4 border border-gray-200 rounded-2xl bg-white placeholder-gray-400 focus:ring-2 focus:ring-blue-600 transition-all shadow-sm font-medium" 
               placeholder="Buscar por produto, CAS ou classificação GHS...">
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-left border-collapse table-fixed">
            <thead class="bg-gray-50/50">
                <tr>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase w-1/4">Produto</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase w-24">CAS</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase w-40">Pictograma</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase w-32">Última Revisão</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase w-28">Status</th>
                    <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center w-32">Ações</th>
                </tr>
            </thead>
            <tbody id="fdsTableBody" class="divide-y divide-gray-50">
                @foreach($products as $product)
                @php
                    $isUpdated = $product->fds_revision_date && $product->fds_revision_date >= \Carbon\Carbon::now()->subYears(2);
                @endphp
                <tr class="fds-row hover:bg-gray-50/50 transition-colors">
                    <td class="p-6 font-bold text-gray-800">{{ $product->name }}</td>
                    <td class="p-6 text-sm text-gray-500 font-mono">{{ $product->cas_number }}</td>
                    <td class="p-6">
                        <div class="text-[11px] text-gray-600 font-bold leading-relaxed" style="word-break: break-word; max-width: 150px;">
                            @if($product->pictograms && is_array($product->pictograms))
                                {{ implode(', ', $product->pictograms) }}
                            @else
                                <span class="text-gray-400 text-xs italic font-normal">Não classificado</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-6 text-sm text-gray-500">
                        {{ $product->fds_revision_date ? $product->fds_revision_date->format('d/m/Y') : 'Pendente' }}
                    </td>
                    <td class="p-6">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $isUpdated ? 'bg-green-50 text-green-600' : 'bg-orange-50 text-orange-600' }}">
                            {{ $isUpdated ? 'Atualizado' : 'Revisar' }}
                        </span>
                    </td>
                    <td class="p-6 text-center" style="min-width: 150px !important;">
                        <a href="{{ url('/fds/download/' . $product->id) }}" 
                           class="inline-flex items-center justify-center bg-blue-600 text-white px-4 py-2 rounded-lg font-bold text-[10px] no-underline shadow-md hover:bg-blue-700"
                           style="display: inline-flex !important; visibility: visible !important; min-height: 30px;">
                            Download
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
function filterFds() {
    let input = document.getElementById('fdsSearch').value.toLowerCase();
    let rows = document.querySelectorAll('.fds-row');
    rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
    });
}
</script>
@endsection