@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Avaliação Técnica de Produto</h2>

    <div class="mb-6 bg-blue-50 p-4 rounded-lg">
        <p class="text-sm text-blue-800 font-bold uppercase tracking-wide">Detalhes da Solicitação</p>
        <p class="mt-2 text-gray-700"><strong>Produto:</strong> {{ $productRequest->product_name }}</p>
        <p class="text-gray-700"><strong>Número CAS:</strong> {{ $productRequest->cas_number ?? 'Não informado' }}</p>
        <p class="text-gray-700"><strong>Solicitante:</strong> {{ $productRequest->requester->name }}</p>
        <div class="mt-4">
            <p class="text-sm text-blue-800 font-bold uppercase tracking-wide">Justificativa do Solicitante</p>
            <p class="text-gray-600 italic">"{{ $productRequest->justification }}"</p>
        </div>
    </div>

    <form action="{{ route('requests.evaluate', $productRequest->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Parecer do Técnico</label>
            <textarea name="evaluator_feedback" required rows="4" 
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm" 
                placeholder="Descreva o motivo da aprovação ou reprovação baseando-se nas normas de segurança..."></textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Decisão Final</label>
            <select name="status" required class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md shadow-sm">
                <option value="approved">Aprovar Produto</option>
                <option value="rejected">Reprovar Produto</option>
            </select>
        </div>

        <div class="flex justify-end items-center mt-6 space-x-3 border-t pt-6">
            <a href="{{ route('requests.index') }}" 
            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Cancelar e Voltar
            </a>
            
            <button type="submit" 
            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Confirmar Avaliação
            </button>
        </div>
    </form>
</div>
@endsection