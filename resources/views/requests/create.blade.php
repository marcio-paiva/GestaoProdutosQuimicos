@extends('layouts.app')

@section('title', 'Solicitação')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Minhas Solicitações</h2>
    
    <a href="{{ route('requests.form') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold">
        Nova Solicitação
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">Produto</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase">CAS</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-center">Status</th>
                <th class="p-6 text-[10px] font-bold text-gray-400 uppercase text-right">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($requests as $req)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="p-6 font-bold text-gray-800">{{ $req->product_name }}</td>
                    <td class="p-6 text-sm text-gray-500 font-mono">{{ $req->cas_number ?? 'N/A' }}</td>
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
                    <td class="p-6 text-right text-xs text-gray-500">
                        {{ $req->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-10 text-center text-gray-500 italic bg-white">
                        Você ainda não realizou nenhuma solicitação.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection