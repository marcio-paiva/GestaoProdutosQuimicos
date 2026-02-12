<?php

namespace App\Http\Controllers;

use App\Models\ProductRequest;
use App\Models\ChemicalProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRequestController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->hasRole('solicitante')) {
            $requests = ProductRequest::where('user_id', $user->id)->latest()->get();
        } else {
            $requests = ProductRequest::with('requester')->latest()->get();
        }

        return view('requests.index', compact('requests'));
    }

    public function create()
    {
        $requests = ProductRequest::where('user_id', auth()->id())->latest()->get();

        return view('requests.create', compact('requests'));
    }

    public function store(Request $request)
        {
            $validated = $request->validate([
                'product_name' => 'required|string|max:255',
                'cas_number'   => 'nullable|string|max:50',
                'justification' => 'required|string',
                'controlled_by' => 'nullable|string',
                'product_type'  => 'nullable|string',
                'fds_revision_date' => 'nullable|date',
                'pictograms'    => 'nullable|array',
                'safety_precautions' => 'nullable|string',
            ]);

            $validated['user_id'] = auth()->id();
            $validated['status'] = 'pending';

            ProductRequest::create($validated);

            return redirect()->route('requests.create')->with('success', 'Solicitação enviada para avaliação técnica!');
        }

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

        if ($validated['status'] === 'approved') {
            ChemicalProduct::create([
                'name'               => $productRequest->product_name,
                'cas_number'         => $productRequest->cas_number,
                'fds_revision_date'  => $productRequest->fds_revision_date, 
                'pictograms'         => $productRequest->pictograms,      
                'safety_precautions' => $productRequest->safety_precautions, 
                'is_approved'        => true,
            ]);
        }

        return redirect()->route('requests.index')->with('success', 'Avaliação registrada!');
    }

    public function approve($id)
    {
        $productRequest = ProductRequest::findOrFail($id);

        ChemicalProduct::create([
            'name'               => $productRequest->product_name,
            'cas_number'         => $productRequest->cas_number,
            'fds_revision_date'  => $productRequest->fds_revision_date,
            'pictograms'         => $productRequest->pictograms,
            'safety_precautions' => $productRequest->safety_precautions,
            'is_approved'        => true,
        ]);
        
        $productRequest->update([
            'status' => 'approved',
            'evaluator_id' => Auth::id()
        ]);

        return redirect()->route('requests.index')->with('success', 'Produto aprovado e ficha FDS gerada!');
    }

    public function showEvaluateForm(ProductRequest $productRequest)
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user->hasRole('avaliador') && !$user->hasRole('adm')) {
            abort(403, 'Acesso negado.');
        }

        return view('requests.evaluate', compact('productRequest'));
    }
}