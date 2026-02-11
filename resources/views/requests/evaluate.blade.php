@extends('layouts.app')

@section('title', 'Avaliação')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Avaliação Técnica de Produto</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="space-y-3">
            <h3 class="text-sm font-bold text-blue-900 uppercase tracking-wider border-b border-blue-100 pb-1">Identificação</h3>
            <p class="text-gray-700"><strong>Produto:</strong> {{ $productRequest->product_name }}</p>
            <p class="text-gray-700"><strong>Número CAS:</strong> {{ $productRequest->cas_number ?? 'Não informado' }}</p>
            <p class="text-gray-700"><strong>Tipo:</strong> {{ $productRequest->product_type ?? 'N/A' }}</p>
            <p class="text-gray-700"><strong>Solicitante:</strong> {{ $productRequest->requester->name }}</p>
        </div>

        <div class="space-y-3">
            <h3 class="text-sm font-bold text-blue-900 uppercase tracking-wider border-b border-blue-100 pb-1">Conformidade e Risco</h3>
            <p class="text-gray-700"><strong>Controlado por:</strong> {{ $productRequest->controlled_by ?? 'N/A' }}</p>
            <p class="text-gray-700"><strong>Revisão FDS:</strong> 
                {{ $productRequest->fds_revision_date ? \Carbon\Carbon::parse($productRequest->fds_revision_date)->format('d/m/Y') : 'Não informada' }}
            </p>
            <div>
                <strong>Pictogramas GHS:</strong>
                <div class="flex flex-wrap gap-1 mt-1">
                    @if($productRequest->pictograms && count($productRequest->pictograms) > 0)
                        @foreach($productRequest->pictograms as $ghs)
                            <span class="bg-gray-100 text-gray-800 text-[10px] font-bold px-2 py-0.5 rounded border border-gray-300">{{ $ghs }}</span>
                        @endforeach
                    @else
                        <span class="text-gray-400 italic text-sm">Nenhum selecionado</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bg-gray-50 p-4 rounded-lg mb-8 space-y-4 border border-gray-100">
        <div>
            <h3 class="text-xs font-bold text-gray-500 uppercase">Justificativa do Solicitante</h3>
            <p class="text-gray-700 italic mt-1">"{{ $productRequest->justification }}"</p>
        </div>
        @if($productRequest->safety_precautions)
        <div>
            <h3 class="text-xs font-bold text-gray-500 uppercase">Cuidados e Recomendações Sugeridos</h3>
            <p class="text-gray-700 mt-1">{{ $productRequest->safety_precautions }}</p>
        </div>
        @endif
    </div>

    <form action="{{ route('requests.evaluate', $productRequest->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label class="block text-sm font-bold text-gray-700 mb-2">Parecer do Técnico</label>
            <textarea name="evaluator_feedback" required rows="4" 
                class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm" 
                placeholder="Descreva o motivo da aprovação ou reprovação baseando-se nas normas de segurança..."></textarea>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-bold text-gray-700 mb-2">Decisão Final</label>
            <select name="status" required class="w-full border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm">
                <option value="approved">Aprovar Produto</option>
                <option value="rejected">Reprovar Produto</option>
            </select>
        </div>

        <div class="flex justify-end items-center space-x-4 border-t pt-6">
            <a href="{{ route('requests.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition shadow-sm font-bold no-underline text-sm inline-flex items-center border border-gray-300">
                Cancelar e Voltar
            </a>
            
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition shadow-md font-bold cursor-pointer border-none inline-flex items-center justify-center text-sm h-[40px]">
                Confirmar Avaliação
            </button>
        </div>
    </form>
</div>
@endsection