<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ChemicalProduct;
use App\Models\Storage;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with(['product', 'storage']);

        // Se vier um ID de depósito pelo link, filtra a consulta
        if ($request->has('storage_id')) {
            $query->where('storage_id', $request->storage_id);
        }

        $inventoryItems = $query->get();
        
        // Opcional: Pegar o nome do depósito para mostrar um título amigável
        $filteredStorage = $request->has('storage_id') 
            ? \App\Models\Storage::find($request->storage_id)?->name 
            : null;

        return view('inventory.index', compact('inventoryItems', 'filteredStorage'));
    }

    public function create()
    {
        // Apenas produtos que já foram aprovados podem entrar no inventário
        $products = ChemicalProduct::where('is_approved', true)->get();
        $storages = Storage::all();
        return view('inventory.create', compact('products', 'storages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chemical_product_id' => 'required|exists:chemical_products,id',
            'storage_id' => 'required|exists:storages,id',
            'quantity' => 'required|numeric|min:0',
            'expiration_date' => 'nullable|date',
        ]);

        Inventory::create($request->all());

        return redirect()->route('inventory.index')->with('success', 'Produto alocado no estoque com sucesso!');
    }
}
