@extends('layouts.app')

@section('title', 'Avaliação')
@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Avaliar Solicitações</h2>
    <p class="text-gray-500 text-sm">Lista de produtos aguardando parecer técnico ou já avaliados.</p>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-xs uppercase font-bold tracking-wider">
                <th class="px-5 py-4">Produto</th>
                <th class="px-5 py-4">CAS</th>
                <th class="px-5 py-4">Solicitante</th>
                <th class="px-5 py-4 text-center">Status</th>
                <th class="px-5 py-4 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @forelse($requests as $req)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-4 text-sm font-bold">{{ $req->product_name }}</td>
                    <td class="px-5 py-4 text-sm text-gray-500">{{ $req->cas_number ?? 'N/A' }}</td>
                    <td class="px-5 py-4 text-sm">{{ $req->requester->name }}</td>
                    <td class="px-5 py-4 text-center">
                        @php
                            $statusTraduzido = [
                                'pending' => 'Pendente',
                                'approved' => 'Aprovado',
                                'rejected' => 'Reprovado'
                            ];
                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                            {{ $req->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            
                            {{ $statusTraduzido[$req->status] ?? $req->status }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if(Auth::user()->hasRole('avaliador') || Auth::user()->hasRole('adm') && $req->status == 'pending')
                            <a href="{{ route('requests.evaluate.form', $req->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold no-underline text-xs inline-flex items-center uppercase tracking-wide">
                                AVALIAR
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-gray-500 italic bg-white">Nenhuma solicitação encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection