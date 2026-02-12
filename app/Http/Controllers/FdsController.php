<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ChemicalProduct;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf; // Importação da biblioteca de PDF

class FdsController extends Controller
{
    public function index()
    {
        $products = ChemicalProduct::where('is_approved', true)->get();
        $doisAnosAtras = Carbon::now()->subYears(2);

        $totalFds = $products->count();
        
        $atualizadas = $products->filter(function($product) use ($doisAnosAtras) {
            return $product->fds_revision_date >= $doisAnosAtras;
        })->count();

        $requerRevisao = $totalFds - $atualizadas;

        return view('fds.index', compact('products', 'totalFds', 'atualizadas', 'requerRevisao'));
    }

    public function downloadFds($id)
    {
        $product = ChemicalProduct::findOrFail($id);

        // Formata o nome do arquivo (ex: fds-acetona.pdf)
        $fileName = 'fds-' . \Illuminate\Support\Str::slug($product->name) . '.pdf';

        $pdf = Pdf::loadView('fds.pdf_individual', compact('product'));
        
        return $pdf->download($fileName);
    }
}