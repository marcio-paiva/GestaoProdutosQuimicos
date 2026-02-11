<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index(Request $request)
    {
        $storages = Storage::withCount('inventory')->get();
        
        // Seleciona o primeiro depósito por padrão ou o que foi clicado
        $selectedStorageId = $request->get('selected', $storages->first()?->id);
        
        $selectedStorage = null;
        $products = collect();

        if ($selectedStorageId) {
            $selectedStorage = Storage::with('inventory.product')->find($selectedStorageId);
            $products = $selectedStorage?->inventory ?? collect();
        }

        return view('storages.index', compact('storages', 'selectedStorage', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255', 
        ]);

        Storage::create([
            'name' => $request->name,
            'location' => $request->location, 
        ]);

        return redirect()->route('storages.index')->with('success', 'Depósito criado!');
    }

    public function create()
    {
        return view('storages.create');
    }
}