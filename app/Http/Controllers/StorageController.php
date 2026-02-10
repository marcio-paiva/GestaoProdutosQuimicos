<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function index()
    {
        $storages = Storage::all();
        return view('storages.index', compact('storages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        Storage::create($request->all());

        return redirect()->route('storages.index')->with('success', 'Depósito cadastrado com sucesso!');
    }
}