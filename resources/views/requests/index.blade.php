@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Solicitações de Produtos</h2>
    
    @if(Auth::user()->hasRole('solicitante'))
        <button onclick="document.getElementById('modalRequest').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition shadow-md">
            + Nova Solicitação
        </button>
    @endif
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
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase
                            {{ $req->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ $req->status }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if(Auth::user()->hasRole('avaliador') && $req->status == 'pending')
                            <a href="{{ route('requests.evaluate.form', $req->id) }}" class="inline-block bg-indigo-100 text-indigo-700 px-3 py-1 rounded font-bold text-xs hover:bg-indigo-200 transition">
                                AVALIAR
                            </a>
                        @else
                            <span class="text-gray-400 text-xs italic font-medium">Concluído</span>
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

<div id="modalRequest" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl shadow-2xl w-full max-w-lg">
        <h3 class="text-xl font-bold mb-6 text-gray-800 border-b pb-4">Nova Solicitação de Produto</h3>
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nome do Produto</label>
                    <input type="text" name="product_name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Número CAS</label>
                    <input type="text" name="cas_number" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Justificativa de Uso</label>
                    <textarea name="justification" required rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>
            <div class="mt-8 flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('modalRequest').classList.add('hidden')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold hover:bg-gray-300">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 shadow-lg">Enviar Solicitação</button>
            </div>
        </form>
    </div>
</div>
@endsection