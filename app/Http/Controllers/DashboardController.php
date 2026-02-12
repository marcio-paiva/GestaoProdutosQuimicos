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
        $totalProducts = \App\Models\Inventory::count();

        $pendingRequests = \App\Models\ProductRequest::where('status', 'pending')->count();

        $approvedProducts = \App\Models\ProductRequest::where('status', 'approved')->count();

        $validityAlerts = \App\Models\Inventory::whereNotNull('expiration_date')
            ->where('expiration_date', '<=', now()->addDays(30))
            ->count();

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