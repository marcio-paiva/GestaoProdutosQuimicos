@extends('layouts.app')

@section('content')
<div class="px-2">
    <div class="mb-8">
        <h2 class="text-3xl font-black text-gray-800 tracking-tight">Início</h2>
        <p class="text-gray-500 font-medium">Resumo operacional do sistema</p>
    </div>

    <div class="flex flex-row space-x-4 mb-10 overflow-x-auto pb-4 md:pb-0">
        
        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between transition-transform hover:scale-[1.02] h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Total de Produtos</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $totalProducts }}</h3>
            </div>
            <div class="bg-blue-50 p-4 rounded-2xl text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>

        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between transition-transform hover:scale-[1.02] h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pendentes</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $pendingRequests }}</h3>
            </div>
            <div class="bg-amber-50 p-4 rounded-2xl text-amber-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between transition-transform hover:scale-[1.02] h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Aprovados</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $approvedProducts }}</h3>
            </div>
            <div class="bg-green-50 p-4 rounded-2xl text-green-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <div class="flex-1 min-w-[250px] bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex items-center justify-between transition-transform hover:scale-[1.02] h-32">
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alertas Validade</p>
                <h3 class="text-3xl font-black text-gray-800 mt-1">{{ $validityAlerts }}</h3>
            </div>
            <div class="bg-red-50 p-4 rounded-2xl text-red-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden mx-2">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
            <h3 class="text-xl font-black text-gray-800">Atividades Recentes</h3>
            <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-widest">Logs de Sistema</span>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentActivities as $activity)
                <div class="p-6 flex justify-between items-center hover:bg-gray-50 transition-all group">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $activity->status == 'approved' ? 'bg-green-100 text-green-600' : ($activity->status == 'rejected' ? 'bg-red-100 text-red-600' : 'bg-amber-100 text-amber-600') }}">
                            @if($activity->status == 'approved')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            @elseif($activity->status == 'rejected')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            @else
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">{{ $activity->product_name }}</p>
                            <p class="text-xs text-gray-500">Solicitado por: <span class="font-medium text-gray-700">{{ $activity->requester->name ?? 'Usuário' }}</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] font-bold px-2 py-1 rounded-md uppercase {{ $activity->status == 'approved' ? 'bg-green-50 text-green-700' : ($activity->status == 'rejected' ? 'bg-red-50 text-red-700' : 'bg-amber-50 text-amber-700') }}">
                            @if($activity->status == 'approved') Aprovado 
                            @elseif($activity->status == 'rejected') Rejeitado
                            @else Pendente @endif
                        </span>
                        <p class="text-[10px] text-gray-400 mt-2 font-medium italic">{{ $activity->updated_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-gray-400 italic bg-white">
                    Nenhuma atividade recente registrada no sistema.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection