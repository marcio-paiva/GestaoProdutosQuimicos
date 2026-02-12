@extends('layouts.app')

@section('title', 'Avaliação')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Avaliar Solicitações</h2>
    <p class="text-gray-500 text-sm">Lista de produtos aguardando parecer técnico ou já avaliados.</p>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Produto</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">CAS</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Solicitante</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center">Status</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($requests as $req)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="p-6 font-bold text-gray-800">{{ $req->product_name }}</td>
                    <td class="p-6 text-sm text-gray-500 font-mono">{{ $req->cas_number ?? 'N/A' }}</td>
                    <td class="p-6 text-sm text-gray-600">{{ $req->requester->name }}</td>
                    <td class="p-6 text-center">
                        @php
                            $statusTraduzido = [
                                'pending' => 'Pendente',
                                'approved' => 'Aprovado',
                                'rejected' => 'Reprovado'
                            ];
                        @endphp

                        <span class="px-3 py-1 rounded-full text-[9px] font-bold uppercase
                            {{ $req->status == 'approved' ? 'bg-green-50 text-green-600' : '' }}
                            {{ $req->status == 'pending' ? 'bg-orange-50 text-orange-600' : '' }}
                            {{ $req->status == 'rejected' ? 'bg-red-50 text-red-600' : '' }}">
                            {{ $statusTraduzido[$req->status] ?? $req->status }}
                        </span>
                    </td>
                    <td class="p-6 text-right">
                        @if((Auth::user()->hasRole('avaliador') || Auth::user()->hasRole('adm')) && $req->status == 'pending')
                            <a href="{{ route('requests.evaluate.form', $req->id) }}" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold no-underline text-[10px] inline-flex items-center uppercase tracking-wider h-[35px]">
                                AVALIAR
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-500 italic bg-white">
                        Nenhuma solicitação encontrada.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection