<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\ProductRequest;
use App\Models\ChemicalProduct;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Total de Produtos no Inventário
        $totalProducts = \App\Models\Inventory::count();

        // 2. Avaliações Pendentes
        $pendingRequests = \App\Models\ProductRequest::where('status', 'pending')->count();

        // 3. Produtos Aprovados
        $approvedProducts = \App\Models\ProductRequest::where('status', 'approved')->count();

        // 4. Alertas de Validade (próximos 30 dias)
        $validityAlerts = \App\Models\Inventory::whereNotNull('expiration_date')
            ->where('expiration_date', '<=', now()->addDays(30))
            ->where('expiration_date', '>=', now())
            ->count();

        // CORREÇÃO: Removemos o 'product' do with() pois a relação não existe
        $recentActivities = \App\Models\ProductRequest::with('requester')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProducts', 
            'pendingRequests', 
            'approvedProducts', 
            'validityAlerts',
            'recentActivities'
        ));
    }
}