<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use App\Models\ChemicalProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    // Listar solicitações (Dashboard)
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        // Agora o PHP sabe que $user tem o método hasRole
        if ($user->hasRole('solicitante')) {
            $requests = ProductRequest::where('user_id', $user->id)->latest()->get();
        } else {
            $requests = ProductRequest::with('requester')->latest()->get();
        }

        return view('requests.index', compact('requests'));
    }

    // Salvar a solicitação (Ação do Solicitante)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'cas_number' => 'nullable|string|max:20',
            'justification' => 'required|string',
        ]);

        ProductRequest::create([
            'user_id' => Auth::id(),
            'product_name' => $validated['product_name'],
            'cas_number' => $validated['cas_number'],
            'justification' => $validated['justification'],
            'status' => 'pending',
        ]);

        return redirect()->route('requests.index')->with('success', 'Solicitação enviada com sucesso!');
    }

    // Avaliar a solicitação (Ação do Avaliador)
    public function evaluate(Request $request, ProductRequest $productRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'evaluator_feedback' => 'required|string',
        ]);

        $productRequest->update([
            'status' => $validated['status'],
            'evaluator_feedback' => $validated['evaluator_feedback'],
            'evaluator_id' => Auth::id(),
        ]);

        // Se aprovado, podemos automaticamente criar o registro na tabela de produtos
        if ($validated['status'] === 'approved') {
            ChemicalProduct::create([
                'name' => $productRequest->product_name,
                'cas_number' => $productRequest->cas_number,
                'is_approved' => true,
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Avaliação registrada!');
    }
}