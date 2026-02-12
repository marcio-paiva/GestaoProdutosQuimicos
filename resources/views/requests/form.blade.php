@extends('layouts.app')

@section('title', 'Solicitação')
@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-8 border border-gray-200">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">Preencher Solicitação</h2>
    
    <form action="{{ route('requests.store') }}" method="POST">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Nome do Produto</label>
                <input type="text" name="product_name" required 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ex: Ácido Sulfúrico 98%">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Número CAS</label>
                <input type="text" name="cas_number" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ex: 7664-93-9">
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Controlado por:</label>
                    <select name="controlled_by" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="N/A">N/A (Não controlado)</option>
                        <option value="Exército">Exército Brasileiro</option>
                        <option value="PF">Polícia Federal</option>
                        <option value="PC">Polícia Civil</option>
                        <option value="IBAMA">IBAMA</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Tipo de Produto:</label>
                    <select name="product_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <option value="Outros">Selecione...</option>
                        <option value="Tinta">Tinta / Revestimento</option>
                        <option value="Lubrificante">Lubrificante / Graxa</option>
                        <option value="Solvente">Solvente</option>
                        <option value="Reagente">Reagente Laboratorial</option>
                        <option value="Detergente">Detergente / Limpeza</option>
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Data de Revisão da FDS (FISPQ):</label>
                <input type="date" name="fds_revision_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
            </div>

            <div class="mt-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Pictogramas de Perigo (GHS):</label>
                <div class="grid grid-cols-3 gap-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                    @foreach(['GHS01', 'GHS02', 'GHS03', 'GHS04', 'GHS05', 'GHS06', 'GHS07', 'GHS08', 'GHS09'] as $ghs)
                        <label class="inline-flex items-center text-xs">
                            <input type="checkbox" name="pictograms[]" value="{{ $ghs }}" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="ml-2">{{ $ghs }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Cuidados e Recomendações:</label>
                <textarea name="safety_precautions" rows="3" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Ex: Manter longe de fontes de calor. Usar luvas de nitrila."></textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Justificativa de Uso</label>
                <textarea name="justification" required rows="4" 
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Descreva a finalidade técnica do produto..."></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 mt-10 border-t border-gray-100 pt-8">
            <a href="{{ route('requests.create') }}" 
            class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-2 rounded-lg transition shadow-sm font-bold no-underline inline-flex items-center justify-center border border-gray-300 text-sm h-[40px]">
                Cancelar e Voltar
            </a>

            <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white min-w-[180px] px-6 py-2 rounded-lg transition shadow-md font-bold cursor-pointer border-none inline-flex items-center justify-center text-sm h-[40px]">
                Enviar Solicitação
            </button>
        </div>
        </div>
        </div>
    </form>
</div>
@endsection