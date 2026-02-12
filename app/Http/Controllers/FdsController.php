<?php

namespace App\Http\Controllers;

use App\Models\Inventory; // Ou o Model que guarda seus produtos aprovados
use Illuminate\Http\Request;
use Carbon\Carbon;

class FdsController extends Controller
{
    public function index()
    {
        $products = \App\Models\ChemicalProduct::where('is_approved', true)->get();

        $doisAnosAtras = \Carbon\Carbon::now()->subYears(2);

        $totalFds = $products->count();
        
        $atualizadas = $products->filter(function($product) use ($doisAnosAtras) {
            return $product->fds_revision_date >= $doisAnosAtras;
        })->count();

        $requerRevisao = $totalFds - $atualizadas;

        return view('fds.index', compact('products', 'totalFds', 'atualizadas', 'requerRevisao'));
    }
}