@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Solicitações de Produtos</h2>
    
    @if(Auth::user()->hasRole('solicitante'))
        <button onclick="document.getElementById('modalRequest').classList.remove('hidden')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">
            + Nova Solicitação
        </button>
    @endif
</div>

<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full leading-normal">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-left text-xs uppercase font-semibold">
                <th class="px-5 py-3">Produto</th>
                <th class="px-5 py-3">CAS</th>
                <th class="px-5 py-3">Solicitante</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3 text-right">Ações</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse($requests as $req)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                    <td class="px-5 py-4 text-sm font-medium">{{ $req->product_name }}</td>
                    <td class="px-5 py-4 text-sm">{{ $req->cas_number ?? 'N/A' }}</td>
                    <td class="px-5 py-4 text-sm">{{ $req->requester->name }}</td>
                    <td class="px-5 py-4 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                            {{ $req->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $req->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $req->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                            {{ strtoupper($req->status) }}
                        </span>
                    </td>
                    <td class="px-5 py-4 text-right">
                        @if(Auth::user()->hasRole('avaliador') && $req->status == 'pending')
                            <button onclick="openEvaluateModal({{ $req->id }}, '{{ $req->product_name }}')" class="text-blue-600 hover:text-blue-900 font-semibold">Avaliar</button>
                        @else
                            <span class="text-gray-400">Ver Detalhes</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 text-center text-gray-500 italic">Nenhuma solicitação encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div id="modalRequest" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">Solicitar Novo Produto</h3>
        <form action="{{ route('requests.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nome do Produto</label>
                <input type="text" name="product_name" required class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Número CAS</label>
                <input type="text" name="cas_number" class="w-full border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Justificativa de Uso</label>
                <textarea name="justification" required class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="document.getElementById('modalRequest').classList.add('hidden')" class="bg-gray-300 px-4 py-2 rounded">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enviar</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Função simples para abrir modal de avaliação (pode ser expandida depois)
    function openEvaluateModal(id, name) {
        alert("Em um próximo passo, abriremos o formulário de aprovação para: " + name);
        // Aqui conectaremos com a rota requests.evaluate
    }
</script>
@endsection