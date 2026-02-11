@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Minhas Solicitações</h2>
    
    <a href="{{ route('requests.form') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md font-bold">
        + Nova Solicitação
    </a>
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-xs uppercase font-bold tracking-wider">
                <th class="px-5 py-4">Produto</th>
                <th class="px-5 py-4">CAS</th>
                <th class="px-5 py-4 text-center">Status</th>
                <th class="px-5 py-4 text-right">Data</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @forelse($requests as $req)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-5 py-4 text-sm font-bold">{{ $req->product_name }}</td>
                    <td class="px-5 py-4 text-sm text-gray-500">{{ $req->cas_number ?? 'N/A' }}</td>
                    <td class="px-5 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                            {{ $req->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $req->status }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right text-xs text-gray-500">
                        {{ $req->created_at->format('d/m/Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-10 text-center text-gray-500 italic bg-white">Você ainda não realizou nenhuma solicitação.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection